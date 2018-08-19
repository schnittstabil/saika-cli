<?php

# clean
foreach (['saika.phar', 'saika_box.phar'] as $file) {
    unlink($file);
}


# create saika.phar
system("box compile");


# repack
rename('saika.phar', 'saika_box.phar');
$dir = sys_get_temp_dir();
$org = new Phar('saika_box.phar');
$org->extractTo($dir);
$repack = new Phar('saika.phar');
$repack->buildFromDirectory($dir);
$repack->setStub("#!/usr/bin/env php\n" . $repack->createDefaultStub('saika'));
system("rm -rf $dir");


# owner, group and permissions
foreach (['saika.phar', 'saika_box.phar'] as $file) {
    chown($file, 1000);
    chgrp($file, 1000);
    chmod($file, 0755);
}
