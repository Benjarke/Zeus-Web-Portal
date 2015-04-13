<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\ZeusUsers;


class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    
	public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
    
    public function testFunctionAction()
    {
		return new Response(
         'IT BLOODY WORKS',
          200,
          array('content-type' => 'text/html')
        );
    }
	
	public function signupFunctionAction()
	{
		$username = $this->getRequest()->get("name");
		$email = md5($this->getRequest()->get("email"));
		$password = md5($this->getRequest()->get("password"));
		$country = $this->getRequest()->get("country_name");
		$action = '\'key\' => $id';

		$zeusUsers = new ZeusUsers();
		$zeusUsers->setusername($username);
		$zeusUsers->setemail($email);
		$zeusUsers->setpassword($password);
		$zeusUsers->setcountry($country);
		$zeusUsers->setaction($action);
		
		$em = $this->getDoctrine()->getManager();

    	$em->persist($zeusUsers);
    	$em->flush();
		
		return new Response(json_encode(array('key' => $zeusUsers->getID())));
	}
	
	public function devicesFunctionAction()
	{	
		$em = $this->getDoctrine()->getManager();
   		$query = $em->createQuery(
      		'SELECT z.id
      		FROM AppBundle:ZeusUsers z
      		ORDER BY z.id DESC');
    	$query->setMaxResults(1);
    	$id = $query->getSingleScalarResult();
			
		return new Response(json_encode(array('key' => $id)));
	}
	
	public function devicesUidDataFunctionAction($id)
	{
  		//This function adds the notification ID to the DB for GCM registeration.
		//Does this by finding the last added ID in the DB and then adds the generated GCM Reg to the notification_id field of that result.
	$notification_id = $this->getRequest()->get('notification_id');
		
		if (isset($notification_id)) {
			
			$notification_id = $this->getRequest()->get('notification_id');
			
			$em = $this->getDoctrine()->getManager();	    
			$query1 = $em->createQueryBuilder();
			$q1 = $query1->update('AppBundle:ZeusUsers', 'z')
			->set('z.notification_id', '?1')
			->where('z.id = ?2')
			->setParameter(1, $notification_id)
			->setParameter(2, $id)
			->getQuery();
			$p = $q1->execute();
			
			return new Response("", 200, array("content-type"=>"text/html"));
		}
		else {
			
			$lat = $this->getRequest()->get('location[lat]', null, true);
		    $lng = $this->getRequest()->get('location[lng]', null, true);
		    $acc = $this->getRequest()->get('location[accuracy]', null, true);
			
			$em = $this->getDoctrine()->getManager();	    
			$query1 = $em->createQueryBuilder();
			$q = $query1->update('AppBundle:ZeusUsers', 'z')
			->set('z.lat', '?1')
			->set('z.lng', '?2')
			->set('z.acc', '?3')
			->where('z.id = ?4')
			->setParameter(1, $lat)
			->setParameter(2, $lng)
			->setParameter(3, $acc)
			->setParameter(4, $id)
			->getQuery();
			$p = $q->execute();
			
			return new Response("", 200, array("content-type"=>"text/html"));
		}
	}
	
	public function VerifyFunctionAction($id)
	{
  		//This function just needs to return the following 'HTTP/1.1 200 OK OK'.
		
		return new Response(json_encode(array('key' => $id)));

	}
	
	public function uidFunctionAction($id)
	{
  		//Will return one of the following arrays;
			//'key' => $id | REG
			//['command' => 'get', 'target' => 'location'] | LOCATION
			//###### | LOCK
			//###### | RING
			
		$em = $this->getDoctrine()->getManager();   
		$query = $em->createQueryBuilder();
		$q = $query->select('z.action')
		->from('AppBundle:ZeusUsers', 'z')
		->where('z.id = ?1')
		->setParameter(1, $id)
		->getQuery();
	
		$action = $q->getSingleScalarResult();
		return new Response(json_encode(array($action)));
	}
	
	public function lockFunctionAction($id)
	{
		//This function recieves the status on the device when the lock request is sent to it.
		 
//		$target = $this->getRequest()->get("target");
//		$command = $this->getRequest()->get("command");
//		$status = $this->getRequest()->get("status"); 
		
		return new Response("", 200, array("content-type"=>"text/html"));
		 
	}
	
}