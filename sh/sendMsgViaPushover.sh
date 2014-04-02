#! /bin/bash

curl -s \
  -F "token=ae8stbH21emfZD8uBUt5sK6NgLUJ8z" \
  -F "user=u9mqqPxNdjYoB9NkJdmiSf8djtw8nM" \
  -F "message=hello world" \
  https://api.pushover.net/1/messages.json
