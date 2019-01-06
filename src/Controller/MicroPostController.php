<?php
/**
 * Created by PhpStorm.
 * User: keith
 * Date: 8/25/18
 * Time: 12:59 PM
 */

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;


/**
 * Class MicroPostController
 * @package App\Controller
 * @Route("/micro-post")
 */
class MicroPostController extends AbstractController
{
	/**
	 * @var \Twig_Environment
	 */
	private $twig;
	/**
	 * @var MicroPostRepository
	 */
	private $microPostRepository;
	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;
	/**
	 * @var RouterInterface
	 */
	private $router;
	/**
	 * @var FlashBagInterface
	 */
	private $flashBag;

	/**
	 * MicroPostController constructor.
	 * @param \Twig_Environment $twig
	 * @param MicroPostRepository $microPostRepository
	 * @param FormFactoryInterface $formFactory
	 * @param EntityManagerInterface $entityManager
	 * @param RouterInterface $router
	 * @param FlashBagInterface $flashBag
	 */
	public function __construct(\Twig_Environment $twig,
								MicroPostRepository $microPostRepository,
								FormFactoryInterface $formFactory,
								EntityManagerInterface $entityManager,
								RouterInterface $router,
								FlashBagInterface $flashBag
		)
	{
		$this->twig = $twig;
		$this->microPostRepository = $microPostRepository;
		$this->formFactory = $formFactory;
		$this->entityManager = $entityManager;
		$this->router = $router;
		$this->flashBag = $flashBag;
	}

	/**
	 * @Route("/", name="micro_post_index")
	 */
	public function index ()
	{
		$html = $this->twig->render('micro-post/index.html.twig', [
//			'posts' => $this->microPostRepository->findAll(),
			'posts' => $this->microPostRepository->findBy([], ['time' => 'DESC']),
		]);

		return new Response($html);
	}

	/**
	 * @Route("/edit/{id}", name="micro_post_edit")
	 * @param MicroPost $microPost
	 * @param Request $request
	 * @return RedirectResponse|Response
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function edit (MicroPost $microPost, Request $request)
	{
		$form = $this->formFactory->create(MicroPostType::class, $microPost);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->entityManager->flush();

			return new RedirectResponse($this->router->generate('micro_post_index'));
		}

		return new Response(
			$this->twig->render('micro-post/add.html.twig',
				[
					'form' => $form->createView(),
				])
		);
	}

	/**
	 * @Route("/delete/{id}", name="micro_post_delete")
	 * @param MicroPost $microPost
	 * @return RedirectResponse
	 */
	public function delete (MicroPost $microPost)
	{
		$this->entityManager->remove($microPost);
		$this->entityManager->flush();

		$this->flashBag->add('notice', 'Micro Post was deleted');

		return new RedirectResponse($this->router->generate('micro_post_index'));
	}

	/**
	 * @Route("/add", name="micro_post_add")
	 * @param Request $request
	 * @return Response
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function add (Request $request)
	{
		$microPost = new MicroPost();
		$microPost->setTime(new \DateTime());

		$form = $this->formFactory->create(MicroPostType::class, $microPost);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->entityManager->persist($microPost);
			$this->entityManager->flush();

			return new RedirectResponse($this->router->generate('micro_post_index'));

		}

		return new Response(
			$this->twig->render('micro-post/add.html.twig',
				[
					'form' => $form->createView(),
				])
		);
	}

	/**
	 * @Route("/{id}", name="micro_post_post")
	 * @param MicroPost $post
	 * @return Response
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function post (MicroPost $post)
	{
//		$post = $this->microPostRepository->find($id);

		return new Response(
			$this->twig->render('micro-post/post.html.twig', [
				'post' => $post,
			])
		);
	}
}














