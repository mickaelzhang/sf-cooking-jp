<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Entity\UserRateRecipe;
use AppBundle\Entity\UserCommentOnRecipe;
use AppBundle\Entity\UserFavoriteRecipe;
use FrontOfficeBundle\Form\RecipeType;
use FrontOfficeBundle\Form\UserRateRecipeType;
use FrontOfficeBundle\Form\UserCommentOnRecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class RecipeController
 *
 * @package FrontOfficeBundle\Controller
 * @Route("recette")
 */
class RecipeController extends Controller
{
    /**
     * Lists all recipe entities.
     *
     * @Route("/", name="recipe_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('@frontend/recipe/list.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * Lists latest recipes
     *
     * @Route("/recentes", name="latest_recipe_list")
     * @Method("GET")
     */
    public function listLatestAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->orderByPublishedDate();

        return $this->render('@frontend/recipe/latest_list.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * Create a new recipe entity
     *
     * @Route("/nouveau", name="recipe_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $recipe->getImage();
            $fileName = $this->get('app_recipe.image_uploader')->upload($file);

            // Update image property to store image file name instead of content
            $recipe->setImage($fileName);

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $recipe->setAuthor($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->redirectToRoute('recipe_show', array('recipeId' => $recipe->getRecipeId()));
        }

        return $this->render('@frontend/recipe/new.html.twig', array(
            'form' => $form->createView(),
            'recipe' => $recipe
        ));
    }

    /**
     * Find and display a recipe entity
     *
     * @Route("/{recipeId}", name="recipe_show")
     */
    public function showAction(Recipe $recipe, Request $request)
    {
        $auth_checker = $this->get('security.authorization_checker')->isGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        // Show comments for this recipe
        $em = $this->getDoctrine()->getManager();
        $recipeId = $recipe->getRecipeId();
        $comments = $em->getRepository('AppBundle:UserCommentOnRecipe')->orderByPublishedAt($recipeId);
        $rating = $em->getRepository('AppBundle:UserRateRecipe')->findRecipeAverageRating($recipeId);
        $favorite = null;

        if ($user) {
            $favorite = $em->getRepository('AppBundle:UserFavoriteRecipe')->findOneBy(
                array(
                    'user' => $user->getUserId(),
                    'recipe' => $recipe->getRecipeId()
                )
            );
        }

        // Create rating form
        $userRating = new UserRateRecipe();
        $ratingForm = $this->createForm(UserRateRecipeType::class, $userRating);
        $ratingForm->handleRequest($request);

        if ($ratingForm->isSubmitted() && $ratingForm->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userRating->setUser($user);
            $userRating->setRecipe($recipe);
            $userRating->setRatedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($userRating);
            $em->flush();

            return $this->redirectToRoute('recipe_show', array('recipeId' => $recipe->getRecipeId()));
        }

        // Create comment form
        $userComment = new UserCommentOnRecipe();
        $commentForm = $this->createForm(UserCommentOnRecipeType::class, $userComment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userComment->setUser($user);
            $userComment->setRecipe($recipe);
            $userComment->setPublishedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($userComment);
            $em->flush();

            return $this->redirectToRoute('recipe_show', array('recipeId' => $recipe->getRecipeId()));
        }

        return $this->render('@frontend/recipe/show.html.twig', array(
            'recipe' => $recipe,
            'comments' => $comments,
            'rating' => $rating,
            'favorite' => $favorite,
            'commentForm' => $commentForm->createView(),
            'ratingForm' => $ratingForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recipe entity.
     *
     * @Route("/{id}/editer", name="recipe_edit")
     * @Method({"GET", "POST"})
     * @Security("recipe.isAuthor(user)")
     *
     * @param Request $request
     * @param Recipe $recipe
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Recipe $recipe)
    {
        $recipe->setImage(
            new File($this->getParameter('image_recipe_directory').'/'.$recipe->getImage())
        );

        $editForm = $this->createForm(RecipeType::class, $recipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $recipe->getImage();
            $fileName = $this->get('app_recipe.image_uploader')->upload($file);
            $recipe->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->redirectToRoute('recipe_show', array('recipeId' => $recipe->getRecipeId()));
        }

        return $this->render('@frontend/recipe/edit.html.twig', array(
            'recipe' => $recipe,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Add to favorite a recipe
     *
     * @Route("/{recipeId}/favori", name="recipe_addToFavorite")
     * @Method("GET")
     *
     * @param Recipe $recipe
     * @return RedirectResponse
     */
    public function addToFavoriteAction(Recipe $recipe)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $userFavoriteRecipe = $em->getRepository('AppBundle:UserFavoriteRecipe')->findOneBy(
            array(
                'user' => $user->getUserId(),
                'recipe' => $recipe->getRecipeId()
            )
        );

        if ($userFavoriteRecipe == null) {
            $userFavoriteRecipe = new UserFavoriteRecipe();
            $userFavoriteRecipe->setUser($user);
            $userFavoriteRecipe->setRecipe($recipe);

            $em->persist($userFavoriteRecipe);
            $em->flush();
        } else {
            $em->remove($userFavoriteRecipe);
            $em->flush();
        }

        return $this->redirectToRoute('recipe_show', array('recipeId' => $recipe->getRecipeId()));
    }
}
