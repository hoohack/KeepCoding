//数据库表role(name, create_time(timestamp))
//找出两个日期之间注册的用户和数量
//DATE_FORMAT(date, '%Y-%m-%d')格式化日期信息
SELECT name, COUNT(*) as a_count
FROM role
WHERE create_time > '2014-09-01' AND create_time < '2014-10-10'
GROUP BY DATE_FORMAT(create_time, '%Y-%m-%d');
或者
SELECT name,COUNT(*) as a_count 
FROM role 
WHERE create_time BETWEEN '2014-09-01' AND '2014-10-10' 
GROUP BY DATE_FORMAT(create_time, '%Y-%m-%d')

//数据库表instructor(id(int), name(varchar), dept_name(varchar), salary(int));
//找出员工的工资大于所在部门的平均工资的人数
SELECT i1.dept_name, COUNT(*) p_count, i2.a_salary 
FROM instructor i1 natural JOIN ( 
  SELECT dept_name, AVG(salary) a_salary 
  FROM instructor 
  GROUP BY dept_name) i2 
WHERE i1.salary > i2.a_salary 
GROUP BY i1.dept_name
