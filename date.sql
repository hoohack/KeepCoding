//找出两个日期之间注册的用户和数量
SELECT name, COUNT(*) as a_count
FROM role
WHERE create_time > '2014-09-01' AND create_time < '2014-10-10'
GROUP BY DATE_FORMAT(create_time, '%Y-%m-%d');
或者
SELECT name,COUNT(*) as a_count 
FROM role 
WHERE create_time BETWEEN '2014-09-01' AND '2014-10-10' 
GROUP BY DATE_FORMAT(create_time, '%Y-%m-%d')
