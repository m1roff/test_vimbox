SELECT t.name, GROUP_CONCAT(s.name SEPARATOR ', ') FROM teacher t
  JOIN teacher_student ts ON t.id = ts.teacher_id
  JOIN student s ON s.id = ts.student_id
GROUP BY t.id
