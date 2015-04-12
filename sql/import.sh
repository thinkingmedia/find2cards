#!/bin/bash
for file in tables/*.sql
do
    echo "Importing ${file}"
    mysql --user=find2cards --password="ghdqbUEo3svfQ8qTObPr" find2cards < $file
done
