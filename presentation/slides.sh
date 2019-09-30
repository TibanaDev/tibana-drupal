#!/usr/bin/env bash
docker run -it -v $HOME/Projects/TibanaDev/tibana-drupal/:/repo -p 9000:9000 gitpitch/desktop:pro
