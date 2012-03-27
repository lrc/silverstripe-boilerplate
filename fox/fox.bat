:: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: 
:: Copy this file to C:\Windows\System32\ for ease of use.  ::
:: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: :: 

@ECHO OFF

:: Use local variables
SETLOCAL

:: Set some variables
SET REPOSITORY=git://github.com/lrc/silverstripe-boilerplate.git
SET HOSTS=C:\Windows\System32\drivers\etc\hosts
SET VHOSTS=C:\Program Files (x86)\Zend\Apache2\conf\extra\httpd-vhosts.conf
SET DOCROOT=%CD%

:: Commands
IF "%1"=="create" GOTO Create
IF "%1"=="help" GOTO Help
GOTO Usage

:Create

:: Check requirements.
CALL git --help >NUL
IF %ERRORLEVEL% NEQ 0 GOTO NoGit
IF "%2"=="" GOTO ProjectNameRequired

:: Clone the git repo
CALL git clone --recursive "%REPOSITORY%" ".\%2"
CALL php -f "%2\fox\setup.php" %2 %3 %4 %5 %6 %7

:: Setup hosts entry
ECHO Adding entry to hosts file.
>>"%HOSTS%" ECHO 127.0.0.1	dev-%2

:: Setup the vhosts entry
ECHO Adding entry to apache vhosts config.
>>"%VHOSTS%" ECHO.
>>"%VHOSTS%" ECHO ^<VirtualHost *:80^>
>>"%VHOSTS%" ECHO	ServerName dev-%2
>>"%VHOSTS%" ECHO	DocumentRoot "%CD%\%2"
>>"%VHOSTS%" ECHO ^</VirtualHost^>

:: Restart apache (just warn for now, not sure how to do on Windows).
ECHO.
ECHO You will need to restart apache for the new vhost to work.

GOTO End

:Usage
ECHO.
ECHO Usage: fox ^<command^> [args]
ECHO.
ECHO Currently, the only command available is:
ECHO     create     Creates a new Silverstripe project in the specified location.
ECHO.
ECHO See 'fox help ^<command^>' for more info about a specific command.
GOTO End

:Help
IF "%2"=="create" GOTO HelpCreate
GOTO Usage

:HelpCreate
ECHO.
ECHO Usage: git add ^<project_name^>
ECHO.
ECHO This command will create a new Silverstripe project in the folder
ECHO specified (e.g. if run from the current directory %DOCROOT%\^<project_name^>)
ECHO.
GOTO End

:ErrorNoGit
ECHO For this installer to work you'll need to install Git (http://git-scm.com/).
GOTO End

:ErrorNoProjectName
ECHO You asked to create a new project but didn't specify a name.
GOTO End

:End
ENDLOCAL
