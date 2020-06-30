<?php

namespace App\Controller;


use App\Entity\Road;
use App\Entity\User;
use App\Entity\Character;
use App\Repository\ChapterRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EshController extends AbstractController
{
    /**
     * @var ObjetctManager
     */
    private $manager;

    /**
     * @var ChapterRepository
     */
    private $chapterRepo;

    public function __construct(ObjectManager $manager, ChapterRepository $chapterRepo)
    {
        $this->manager = $manager;
        $this->chapterRepo = $chapterRepo;
    }
    /**
     * @Route("/", name="esh_home")
     */
    public function home()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $users = $repo->findAll();

        return $this->render('esh/home.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @route("/rules", name="esh_rules")
     */
    public function rules()
    {
        return $this->render('esh/rules.html.twig', []);
    }

    /**
     * @Route("/memberPage", name="memberPage")
     */
    public function adminMemberPage()
    {
        $user = $this->getUser();

        return $this->render('esh/memberPage.html.twig', [
            'user' => $user,

        ]);
    }
    //Cette fonction est lancer au moment du clique sur le nom du personnage dans la page adminMemberPage.html.twig.Elle permet de lancer l'affichage des chapitres en fonction de la position ($currentChapter) du personnage.
    /**
     * @Route("/readBook/initiate/{id}", name="readBook_initiate")
     */
    public function initiate(Character $character)
    {
        $currentChapter = $character->getCurrentChapter();

        if ($currentChapter === null) {
            $character->setCurrentChapter($this->chapterRepo->findOneByNumber('1'));
            $this->manager->flush();
            return $this->redirectToRoute('book_read', ['id' => $character->getId()]);
        } else {
            return $this->redirectToRoute('book_read', ['id' => $character->getId()]);
        }
    }

    /**
     * @Route("/readBook/character/{character}/road/{road}", name="readBook_goToChapter")
     */
    public function goToChapter(Character $character, Road $road)
    {
        if ($road->getTargetChapter() === null) {
            $character->setCurrentChapter(null);
            $this->manager->flush();
            return $this->redirectToRoute('memberPage');
        } else {

            $character->setCurrentChapter($road->getTargetChapter());
            $this->manager->flush();
            return $this->redirectToRoute('book_read', ['id' => $character->getId()]);
        }
    }

    /**
     * @Route("/read/{id}", name="book_read")
     */
    public function read(Character $character)
    {

        $user = $this->getUser();
        $currentChapter = $character->getCurrentChapter();
        $chapter = $this->chapterRepo->find($currentChapter);

        return $this->render('book/readBook.html.twig', [
            'user' => $user,
            'character' => $character,
            'chapter' => $chapter,
        ]);
    }

    /**
     * Legal notice page.
     *@Route("legalNotice", name="legal")
     * @return void
     */
    public function legalNotice()
    {
        return $this->render('esh/legalNotices.html.twig');
    }
}
