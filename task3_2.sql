SELECT
  t.name,
  t2.name,
  count(*) AS scount
FROM teacher t
  JOIN teacher_student ts1 ON ts1.teacher_id = t.id
  JOIN teacher_student ts2 ON ts2.student_id = ts1.student_id
  JOIN teacher t2 ON t2.id = ts2.teacher_id AND t2.id > t.id
GROUP BY t.id, t2.id
ORDER BY scount DESC
LIMIT 1
