#!/bin/bash
node index.js &
test_pid=$!
sleep 1
vendor/phpunit/phpunit/phpunit.php
kill $test_pid

