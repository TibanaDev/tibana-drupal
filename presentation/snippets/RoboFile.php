<?php

class RoboFile extends \Robo\Tasks {

  function test() {

  }

  function spec() {
    $this->taskCodecept('vendor/bin/codecept')
      ->suite('acceptance')
      ->run();
  }

  public function generateTheme() {
    $themePath = "web/themes/custom/" . getenv('CLIENT_NAME') . "_theme/";
    $collection = $this->collectionBuilder();
    $tmpPath = $collection->tmpDir();
    $collection->taskExec("curl https://ftp.drupal.org/files/projects/tailwindcss-8.x-2.4.tar.gz -o $tmpPath/tailwind.tar.gz")
      ->taskExtract("$tmpPath/tailwind.tar.gz")
      ->to($themePath)
      ->taskFilesystemStack()
      ->rename("$themePath/tailwindcss.info.yml", "$themePath/" . getenv('CLIENT_NAME') . "_theme.info.yml")
      ->rename("$themePath/tailwindcss.libraries.yml", "$themePath/" . getenv('CLIENT_NAME') . "_theme.libraries.yml")
      ->rename("$themePath/tailwindcss.theme", "$themePath/" . getenv('CLIENT_NAME') . "_theme.theme")
      ->taskReplaceInFile("$themePath/" . getenv('CLIENT_NAME') . "_theme.theme")
      ->from('tailwindcss_')
      ->to(getenv('CLIENT_NAME') . "_theme_")
      ->taskReplaceInFile("$themePath/" . getenv('CLIENT_NAME') . "_theme.info.yml")
      ->from('tailwindcss')
      ->to(getenv('CLIENT_NAME') . "_theme");
    return $collection;
  }
}

