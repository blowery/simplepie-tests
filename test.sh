#!/bin/bash
node index.js &
test_pid=$!
sleep 0.5
vendor/phpunit/phpunit/phpunit.php
kill $test_pid

