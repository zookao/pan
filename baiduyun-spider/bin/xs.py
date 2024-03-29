# -*- coding: utf-8 -*-
import requests
# import re
from bs4 import BeautifulSoup
import MySQLdb as mdb
import traceback
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

DB_HOST = 'localhost'
DB_PORT = '3306'
DB_USER = 'root'
DB_PASS = 'root'
DB_NAME = 'pan'

class Db(object):
    def __init__(self):
        self.dbconn = None
        self.dbcurr = None

    def check_conn(self):
        try:
            self.dbconn.ping()
        except:
            return False
        else:
            return True

    def conn(self):
        self.dbconn = mdb.connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, charset='utf8')
        self.dbconn.autocommit(False)
        self.dbcurr = self.dbconn.cursor()

    def fetchone(self):
        return self.dbcurr.fetchone()

    def fetchall(self):
        return self.dbcurr.fetchall()

    def execute(self, sql, args=None, falg=False):
        if not self.dbconn:
            # 第一次链接数据库
            self.conn()
        try:
            if args:
                rs = self.dbcurr.execute(sql, args)
            else:
                rs = self.dbcurr.execute(sql)
            return rs
        except Exception, e:
            if self.check_conn():
                print 'execute error'
                traceback.print_exc()
            else:
                print 'reconnect mysql'
                self.conn()
                if args:
                    rs = self.dbcurr.execute(sql, args)
                else:
                    rs = self.dbcurr.execute(sql)
                return rs

    def commit(self):
        self.dbconn.commit()

    def rollback(self):
        self.dbconn.rollback()

    def close(self):
        self.dbconn.close()
        self.dbcurr.close()

    def last_row_id(self):
        return self.dbcurr.lastrowid

def xsdq():
    db = Db()
    for i in range(1,25):
        if i == 1:
            url = 'http://r.qidian.com/fin?style=1&dateType=3'
            # pass
        else:
            url = 'http://r.qidian.com/fin?style=1&dateType=3&page=%d' % i
        content = requests.get(url).content
        soup = BeautifulSoup(content, 'html5lib')

        for div in soup.find_all('div', {'class' : 'book-mid-info'}):
            title = div.h4.a.string
            if title is None:
                pass
            else:
                if db.execute('SELECT * FROM topic WHERE title=%s', (title,)) > 0:
                    print '%s 已经采集过了' % title
                    continue
                else:
                    db.execute("INSERT INTO topic (title,type) VALUES(%s,%s)", (title, 3))
                    db.commit()
                    print '%s 采集成功' % title

if __name__ == '__main__':
    xsdq()