#!/bin/sh

# start phddns
cd /home/pi/bin/phddns/
./phddns -d

#start mjpg-streamer
cd /home/pi/bin/mjpg-streamer/
sh start.sh