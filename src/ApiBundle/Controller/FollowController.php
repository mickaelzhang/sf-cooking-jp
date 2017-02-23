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
            return new JsonResponse(array(
                'status' => 'Not Acceptable',
                'status_code' => 406,
                'message' => 'You can access this only using Ajax!'
            ), 406);
        }

        // Data from request
        $followerId = $request->get('follower');
        $followedId = $request->get('followed');
        $submittedToken = $request->get('token');

        // Make sure the token send is valid
        // tokenId -> follow_follower{followerId}_followed{followedId}
        $tokenId = 'follow_follower'.$followerId.'_followed'.$followedId;

        if (!$this->isCsrfTokenValid($tokenId, $submittedToken)) {
            return new JsonResponse(array(
                'status' => 'Unauthorized',
                'status_code' => 401,
                'message' => 'Invalid Token.'
            ), 401);
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

            return new JsonResponse(array(
                'status' => 'Created',
                'status_code' => 201,
                'message' => $follower->getUsername().' follow '.$userFollowed->getUsername()
            ), 201);
        } else {
            $em->remove($userFollow);
            $em->flush();

            return new JsonResponse(array(
                'status' => 'OK',
                'status_code' => 200,
                'message' => $follower->getUsername().' don\'t follow '.$userFollowed->getUsername().' anymore'
            ), 200);
        }
    }
}
