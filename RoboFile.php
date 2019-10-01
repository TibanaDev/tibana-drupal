<?php

/**
 * @file
 * Project Robo tasks.
 */

use Robo\Tasks;

/**
 * RoboFile.
 */
class RoboFile extends Tasks {
  use \Boedah\Robo\Task\Drush\loadTasks;

  /**
   * Run all QA.
   */
  public function test() {
    $this->lint()
      ->spec();
  }

  /**
   * Run Codesniffer.
   */
  public function lint() {
    $this->taskExec('vendor/bin/phpcs -n --report=full --standard=Drupal --ignore=*/node_modules/*,/vendor/*,*.md,*.tpl.php,*.css,*.scss --extensions=install,module,php,inc web/modules/custom/ web/themes/custom/ RoboFile.php')
      ->run();
    return $this;
  }

  /**
   * Run Beautifier.
   */
  public function fix() {
    $this->taskExec('phpcbf --standard=Drupal --ignore=*/node_modules/*,/vendor/*,*.md,*.tpl.php,*.css,*.scss --extensions=install,module,php,inc web/modules/custom/ web/themes/custom/ RoboFile.php')
      ->run();
    return $this;
  }

  /**
   * Run Acceptance Tests.
   */
  public function spec() {
    $this->taskCodecept('vendor/bin/codecept')
      ->suite('acceptance')
      ->run();
    return $this;
  }

  /**
   * Install Drupal.
   */
  public function installDrupal() {
    return $this->taskDrushStack()
      ->siteName(getenv('CLIENT_NAME'))
      ->siteMail('developers@tibanadev.io')
      ->accountMail('developers@tibanadev.io')
      ->accountName('notadmin')
      ->siteInstall('standard')
      ->run();
  }

  /**
   * Generate a Theme.
   */
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
