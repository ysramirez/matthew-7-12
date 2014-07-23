<?php

namespace Grace\Collabs;

use Alchemy\Zippy\Zippy;

class ZipperZippy implements Zipper
{
    protected $fs;
    protected $zipAdapter;

    public function __construct(FileSystem $fs)
    {
        $this->fs = $fs;
        $zippy = Zippy::load();
        $this->zipAdapter = $zippy->getAdapterFor('zip');
    }

    public function zipAndBreak(array $patches)
    {
        $archiveZip = $this
            ->zipAdapter
            ->create('compressAllFirst.zip')
            ->addMembers($patches, $recursive = false)
        ;
        
        // zip -s 2 --output split_zip_
        $files = $finder->file()->in()->expr();
        foreach ($files as $file) {
            $manyCompressed[] = $file->getName();
        }

        return $manyCompressed;
    }

    public function unzipAndJoin()
    {
        foreach (['archive.zip', 'archive2.zip', 'archive3.zip'] as $path) {
            $archive = $zipAdapter->open($path);
        }

        // extracts
        $archiveZip->extract('/to/directory');
    }

    public static function callback(array $args)
    {
        return (new self(new FileSystemSymfony()))->zipAndBreak($args[0]);
    }
}
