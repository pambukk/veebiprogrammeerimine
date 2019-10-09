#!/bin/bash
uuendus=`date +%F`
git add .;
git commit -m $uuendus;
git push;
