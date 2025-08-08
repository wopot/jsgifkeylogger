jsgifkeylogger
==============


=== Update 08/2025 ===

It`s the 08 August.
I never thought this PoC would still be working in 2025, but you never know.<br>
So now let's arm the thing.


Hidding the JS Payload "inside" a GIF

The JS Payload:

```
src/cleanTextShell.js
```

need to get minify 
```
src/minifyJSShell.js
```
and than added into the

```
gifjs.asm
```
than complail with FASM or NASM

Now we have a Polyglot GIF that can be served by a ngnix or apache httpd

We have build a docker-compose ngnix setup for simulation, 
to serv the payload AND the backend.
> Normally that do not need to be on the same server.


They JS send a HTTP GET Call to the backend on every key input.
> Normally a buffer is usefull.

The HTTP GET Call look like a typical webpack js file
```
  http://localhost:8080/assets/js/view.111086.js
```
But we only want the string: "086" (keyCode for "V"). <br>
The hacky PHP Backend is only for testing. It saves the keyCode into an IP labeled txt file. 


We try to bypass firewalls with IDS, DPI and other hyped ai/blockchain tech. 

> If it looks like a duck, swims like a duck, and quacks like a duck, then it probably is a duck or a JS keylogger

> the entrance is not always the exit of a dataflow


=== Update 2025 ===

Adding Apache HTTP .htaccess for mime type spoofing by [@FF-Ibb-PD](https://github.com/FF-Ibb-PD)

Works on:
- Microsoft Edge 139 (2025/08/07)


=== 2013 ===

a javascript keylogger included in a gif file 
This is a PoC

The idea to inlcuding javascript in a .gif file came form Saumil Shah @therealsaumil 
(site:  http://www.net-square.com ) <br>
This technique he named "**IMAJS**" <br>
The asm file for this, came form  Ange Albertini @angealbertin ( site: http://code.google.com/p/corkami/ )

**only** for tests

more infos: <br>
https://deepsec.net/docs/Slides/2012/DeepSec_2012_Saumil_Shah_-_Bad_Things_in_good_Packages.pdf


this is a basic PoC <br>
no evasion nor bypass of JS Filters <br>
For some more fun with obf. JS visit https://www.owasp.org/index.php/XSS_Filter_Evasion_Cheat_Sheet
