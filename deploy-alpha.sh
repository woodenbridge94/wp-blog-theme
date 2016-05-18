#!/bin/sh

SSHSERVER="stadig"
REMOTE_LOC="~/public_html/wp-content/themes/pb2015"
TIME=$(date +"%Y-%m-%d_%H-%M-%S")

# archive the current commit of the repo into /tmp folder
git archive HEAD -o /tmp/pb2015-$TIME.tar
# copy that archive to the production server
scp /tmp/pb2015-$TIME.tar $SSHSERVER:/tmp/pb2015-$TIME.tar
# potentially dangerous. 
# 1) removes old theme on production server!
# 2) untars the new version of the them into location on the production server
ssh $SSHSERVER "rm -rf $REMOTE_LOC; mkdir $REMOTE_LOC; tar -xf /tmp/pb2015-$TIME.tar -C $REMOTE_LOC"