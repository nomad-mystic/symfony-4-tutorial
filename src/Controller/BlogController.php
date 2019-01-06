<?php
/**
 * Created by PhpStorm.
 * User: keith
 * Date: 8/23/18
 * Time: 8:56 PM
 */

namespace App\Controller;

use App\Service\Greeting;
use http\Exception\RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Twig_Environment;

/**
 * @Route("/blog")
 * Class BlogController
 * @package App\Controller
 */
class BlogController extends AbstractController
{
	/**
	 * @var Greeting
	 */
	private $greeting;
	/**
	 * @var Twig_Environment
	 */
	private $twig;

	private $html;
	/**
	 * @var SessionInterface
	 */
	private $session;
	/**
	 * @var RouterInterface
	 */
	private $router;

	/**
	 * BlogController constructor.
	 * @param Twig_Environment $twig
	 * @param SessionInterface $session
	 * @param RouterInterface $router
	 */
//	public function __construct(Greeting $greeting, Twig_Environment $twig)
	public function __construct(Twig_Environment $twig, SessionInterface $session, RouterInterface $router)
	{
//		$this->greeting = $greeting;
		$this->twig = $twig;
		$this->session = $session;
		$this->router = $router;
	}

	/**
	 * @Route("/", name="blog_index")
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws LoaderError
	 * @throws SyntaxError
	 * @throws RuntimeError
	 */
	public function index()
	{
//		$this->get('app.greeting');
//		return $this->render('base.html.twig', [
//			'message' => $this->greeting->greet(
//				$request->get('name')
//			)
//		]);

//			$this->html = $this->twig->render('base.html.twig', [
//				'message' => $this->greeting->greet(
//					$name
//				)
//			]);

		$this->html = $this->twig->render('blog/index.html.twig', [
				'posts' => $this->session->get('posts'),
			]);


		return new Response($this->html);
	}

	/**
	 * @Route("/add", name="blog_add")
	 */
	public function add()
	{
		$posts = $this->session->get('posts');
		$posts[uniqid()] = [
			'title' => 'A random post' . rand(0, 500),
			'text' => 'Some random text' . rand(0, 500),
			'date' => new \DateTime(),
		];
		$this->session->set('posts', $posts);

		return new RedirectResponse($this->router->generate('blog_index'));
	}

	/**
	 * @Route("/show/{id}", name="blog_show")
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function show($id)
	{
		$posts = $this->session->get('posts');

		if (!$posts || !isset($posts[$id])) {
			throw new NotFoundHttpException('Post not found');
		}

		$this->html = $this->twig->render(
			'blog/post.html.twig',
			[
				'id' => $id,
				'post' => $posts[$id],
			]
		);

		return new Response($this->html);
	}
}
