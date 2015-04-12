#!/bin/bash
rm tables/*.sql
while read -r table
do
    echo "Dumping ${table}"
    mysqldump --user=find2cards --password="ghdqbUEo3svfQ8qTObPr" --no-data --hex-blob --add-drop-table --single-transaction find2cards $table > tables/$table.sql
done < <(mysql --user=find2cards --password="ghdqbUEo3svfQ8qTObPr" --batch --disable-column-names --execute="show tables;" find2cards)
