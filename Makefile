test: vendor
	./test.sh

vendor:
	composer install;

distclean:
	rm -rf vendor;

@PHONY: test distclean
  
