#!/usr/bin/env bash
if [ $# -eq 0 ]
  then
    vagrant ssh -c "cd /var/www/manatiblog; ./vendor/bin/behat"
else
  vagrant ssh -c "cd /var/www/manatiblog; ./vendor/bin/behat ./tests/behat/features/$1.feature"
fi
