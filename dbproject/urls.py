from django.conf.urls import patterns, include, url

from django.contrib import admin
admin.autodiscover()
from home.views import *

urlpatterns = patterns('',
    # Examples:
    # url(r'^$', 'dbproject.views.home', name='home'),
    # url(r'^blog/', include('blog.urls')),

    url(r'^admin/', include(admin.site.urls)),
    url(r'^home', 'home.views.home'),
)
