<?php


namespace AppBundle\Controller;
use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
//    /**
//     * @Route("/projects/new")
//     */
//    public function newProject() {
//        $project = new Project();
//        $project->setTitle('House' . rand(1, 100));
//        $project->setDescription('skjdhfskjdfhs');
//        $project->setImages('test');
//        $project->setStrapline('Another one');
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($project);
//        $em->flush();
//
//        return new Response('<html><body>New project added</body></html>');
//    }

    /**
     * @Route("/projects/{title}", name="project_individual")
     */
    public function showProject($title)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Project')
            ->findOneBy(['title' => $title]);

        if(!$project) {
            throw $this->createNotFoundException('Project not found');
        }

        return $this->render('projects/project.html.twig', [
          'project' => $project
        ]);


    }

    /**
     * @Route("/projects")
     */
    public function showProjects()
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('AppBundle:Project')
            ->findAll();


        return $this->render('projects/projects.html.twig', [
            'projects' => $projects
        ]);
    }


}
