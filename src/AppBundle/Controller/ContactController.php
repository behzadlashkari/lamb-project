<?php


namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contact_form")
     */
    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm('AppBundle\Form\ContactType',null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('contact_form'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :

                    return $this->redirectToRoute('homepage');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor :(");
                }
            }
        }

        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){

        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')->setUsername('bezlash@gmail.com')->setPassword('Bulg4r147796');

        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance('Our Code World Newsletter')
            ->setFrom(array('bezlash@gmail.com' => 'Our Code World'))
            ->setTo(array("bezlash@gmail.com" => "bezlash@gmail.com"))
            ->setBody("<h1>Welcome</h1>", 'text/html');
        return $mailer->send($message);
        // @TODO - email being sent doesn't include form input messages e.g. name etc
    }
}
