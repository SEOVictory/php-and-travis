#!/usr/bin/env bash

# Used in .git/hooks/pre-commit with the following code snipet
#
# LINT="$(git rev-parse --show-toplevel)/code-sniffer.sh"
# $LINT
# if [ $? -ne 0 ]; then
#     echo "Not committing do to Lint errors."
#     exit 1
# fi

cd $(git rev-parse --show-toplevel)

PHPCS=$(which phpcs)
STANDARD="Zend"

if [ -z "$PHPCS" ]; then
    echo "phpcs (CodeSniffer) not installed"
    exit 1000
fi

RESULT=0
while read fn; do
    $PHPCS --standard=$STANDARD "$fn"
    RESULT=$(($? + $RESULT))
done < <(find . -name "*.php")

exit $RESULT