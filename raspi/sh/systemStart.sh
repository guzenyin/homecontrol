#!/bin/sh

# start phddns
cd /home/pi/bin/phddns/
./phddns -d

#start mjpg-streamer
cd /home/pi/bin/mjpg-streamer/
sh start.sh

#start flask
#. /home/pi/venv/bin/activate

#cd /home/pi/homecontrol/raspi/py
#nohup python systemStart.py >/dev/null 2>&1 &
