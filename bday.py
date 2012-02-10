import couchdb
import mechanize
import cookielib
import time
# Browser
br = mechanize.Browser()

#Database
couch = couchdb.Server()
db = couch['iitjee']

# Cookie Jar
cj = cookielib.CookieJar()
br.set_cookiejar(cj)

# Browser options
br.set_handle_equiv(True)
br.set_handle_redirect(True)
br.set_handle_referer(True)
br.set_handle_robots(False)

# Follows refresh 0 but not hangs on refresh > 0
br.set_handle_refresh(mechanize._http.HTTPRefreshProcessor(), max_time=1)

# Want debugging messages?
#br.set_debug_http(True)
#br.set_debug_redirects(True)
#br.set_debug_responses(True)

# User-Agent (this is cheating, ok?)
br.addheaders = [('User-agent', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.1) Gecko/2008071615 Fedora/3.0.1-1.fc9 Firefox/3.0.1')]

# Open some site, let's pick a random one, the first that pops in mind:
r = br.open('http://jee.iitm.ac.in/viewapp/index.php');


# Show the available forms

# Select the first (index zero) form
br.select_form(nr=0)
br.form['appln_no']='B364036489'
br.form['regn_no']='6155028'
br.form['day']=["24"]
br.form['month']=["02"]
br.form['year']=["1993"]
br.submit()

print cj.value

for l in br.links(url_regex='pap'):
	print l
	br.follow_link(l)
	print br.geturl()

