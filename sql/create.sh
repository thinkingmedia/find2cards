#!/bin/bash
mysql --user=root --password="${1}" < create.sql
