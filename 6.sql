SELECT department_id
FROM evaluations
WHERE gender = true
GROUP BY department_id
HAVING MIN(value) > 5;