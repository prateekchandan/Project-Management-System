from django.shortcuts import render
from django.http import HttpResponse,HttpResponseRedirect
from django.template.loader import get_template
from home.models import *

def home(request):
	return render(request,"index.html",{"name":"Prateek"})
	
