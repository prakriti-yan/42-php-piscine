SELECT COUNT(*) AS `nb_susc`, 
		ROUND(AVG(`price`), 0) AS `av_susc`,
        SUM(`duration_sub`) % 42 AS `ft`
FROM `subscription`;