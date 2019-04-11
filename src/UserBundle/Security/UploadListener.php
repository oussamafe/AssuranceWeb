<?php
/**
 * Created by PhpStorm.
 * User: Oussama Fezzani
 * Date: 09/04/2019
 * Time: 14:48
 */

namespace UserBundle\Security;



use Doctrine\ORM\EntityManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use GarantiaBundle\Entity\ImagesActu;
use GarantiaBundle\Entity\Actualite;

class UploadListener
{
    protected $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function onUpload(PostPersistEvent $event)
    {

        /*$type=$event->getType();


        $file = $event->getFile();
        $file->getFilename();
        if($type == 'gallery')
        {

            $actu = new Actualite();
            $actu->setDescription('test desc');
            $actu->setImage($file->getFilename());
            $actu->setTitre('test titre');
            $actu->setDatePublication();
            $this->manager->persist($actu);
            $this->manager->flush();


        }
        elseif ($type == 'albums')
        {
            $lastQuestion = $this->manager->getRepository('GarantiaBundle:Actualite')->findOneBy([], ['id' => 'desc']);
            $object = new ImagesActu();
            $object->setUrl($file->getFilename());
            $object->setIdActu($lastQuestion);
            $this->manager->persist($object);
            $this->manager->flush();
        }*/

    }
}