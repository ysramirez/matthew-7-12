<?php

namespace Grace;

class ZipperZippy implements Zipper
{
    public function __construct()
    {
        $zippy = Zippy::load();

        $zipAdapter = $zippy->getAdapterFor('zip');

        // creates
        $archiveZip = $zippy->create('archive.zip');

        // updates
        $archiveZip->addMembers([
                '/path/to/file',
                '/path/to/file2',
                '/path/to/dir'
            ],
            $recursive = false
        );

        // lists
        foreach ($archiveZip as $member) {
            if ($member->isDir()) {
                continue;
            }

            echo $member->getLocation(); // outputs /path/to/file
        }
    }

    public function zipAndBreak()
    {

    }

    public function unzipAndJoin()
    {
        foreach(array('archive.zip', 'archive2.zip', 'archive3.zip') as $path) {
            $archive = $zipAdapter->open($path);
        }

        // extracts
        $archiveZip->extract('/to/directory');
    }
}