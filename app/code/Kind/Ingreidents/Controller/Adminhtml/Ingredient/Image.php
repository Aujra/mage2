<?php


namespace Kind\Ingreidents\Controller\Adminhtml\Ingredient;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\Framework\FileSystem;

class Image extends \Magento\Backend\App\Action
{
    protected $_fileUploaderFactory;
    protected $_filesystem;

    public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        FileSystem $fileSystem,
        Action\Context $context

    ) {
        $this->_filesystem = $fileSystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'images']);
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);
        $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('images/');
        $uploader->save($path);
        return;
    }
}
