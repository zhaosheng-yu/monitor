# 事件打点监控系统

### 本系统主要分为三部分
* 上报接口(service)
* 数据分析告警(crontab)
* 后台(admin)

#### 上报接口(多语言版)
- php版接口说明
* 接口文件：service/php/api/report.php
* 接口请求方式：http POST 提交
* 接口参数：sign(签名)、t(时间戳)、data(json数据包，参数格式说明例：{monitorid:123,time:1514190464,source:100})

### 数据表说明
+ 数据上报表t_report_业务号(如t_report_1001,1001为业务号);  
字段说明：date:日期，minute:当前分值(1-1440), num:每分钟上报数据量, source:来源或版本号。
+ 监控业务表

