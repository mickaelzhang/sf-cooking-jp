<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\UserFollow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class FollowController
 *
 * @package ApiBundle\Controller
 * @Route("follow")
 */
class FollowController extends Controller
{
    /**
     * Add to favorite
     *
     * @Route("/", name="api_follow_user")
     * @Method("POST")
     */
    public function followUserAction(Request $request) {
        // Make sure the request is from ajax
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        // Data from request
        $followerId = $request->get('follower');
        $followedId = $request->get('followed');
        $submittedToken = $request->get('token');

        // Make sure the token send is valid
        // tokenId -> follow_follower{followerId}_followed{followedId}
        $tokenId = 'follow_follower'.$followerId.'_followed'.$followedId;

        if (!$this->isCsrfTokenValid($tokenId, $submittedToken)) {
            return new JsonResponse(array('message' => 'Invalid Token.'), 400);
        }

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('AppBundle:User');

        $follower = $userRepository->find($followerId);
        $userFollowed = $userRepository->find($followedId);

        $userFollow = $em->getRepository('AppBundle:UserFollow')->findOneBy(
            array(
                'follower' => $follower,
                'userFollowed' => $userFollowed,
            )
        );

        if ($userFollow == null) {
            $userFollow = new UserFollow();
            $userFollow->setFollower($follower);
            $userFollow->setUserFollowed($userFollowed);
            $em->persist($userFollow);
            $em->flush();

            return new JsonResponse(array('message' => 'User dont follow right now'), 200);
        } else {
            $em->remove($userFollow);
            $em->flush();

            return new JsonResponse(array('message' => 'User is following this dude'), 200);
        }
    }
}
