#!/bin/bash
for file in data/*.sql
do
    echo "Importing ${file}"
    mysql --user=memory --password="ghdqbUEo3svfQ8qTObPr" memory < $file
done
