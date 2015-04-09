#!/bin/bash
rm data/*.sql
while read -r table
do
    echo "Dumping ${table}"
    mysqldump --user=memory --password="ghdqbUEo3svfQ8qTObPr" --hex-blob --add-drop-table memory $table > data/$table.sql
done < <(mysql --user=memory --password="ghdqbUEo3svfQ8qTObPr" --batch --disable-column-names --execute="show tables;" memory)
