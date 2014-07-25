vendor:
	composer install;

distclean:
	rm -rf vendor;

test: vendor
	test.sh

@PHONY: test
  
