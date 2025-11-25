@echo off
echo Starting PHP Development Server...
echo.

REM Check for XAMPP
if exist "C:\xampp\php\php.exe" (
    echo Using XAMPP PHP...
    cd /d "%~dp0"
    start "PHP Server" cmd /k "C:\xampp\php\php.exe -S localhost:8000"
    timeout /t 3 /nobreak >nul
    start http://localhost:8000
    echo.
    echo Server started! Opening browser...
    echo Press any key to stop the server...
    pause >nul
    exit
)

REM Check for WAMP
if exist "C:\wamp64\bin\php\php*\php.exe" (
    echo Using WAMP PHP...
    cd /d "%~dp0"
    for /d %%i in ("C:\wamp64\bin\php\php*") do (
        start "PHP Server" cmd /k "%%i\php.exe -S localhost:8000"
        timeout /t 3 /nobreak >nul
        start http://localhost:8000
        echo.
        echo Server started! Opening browser...
        echo Press any key to stop the server...
        pause >nul
        exit
    )
)

REM If PHP is in PATH
where php >nul 2>&1
if %errorlevel% == 0 (
    echo Using system PHP...
    cd /d "%~dp0"
    start "PHP Server" cmd /k "php -S localhost:8000"
    timeout /t 3 /nobreak >nul
    start http://localhost:8000
    echo.
    echo Server started! Opening browser...
    echo Press any key to stop the server...
    pause >nul
    exit
)

echo.
echo ========================================
echo ERROR: PHP not found!
echo ========================================
echo.
echo You need to install PHP to run this project.
echo.
echo OPTION 1: Install XAMPP (Recommended)
echo   1. Download from: https://www.apachefriends.org/
echo   2. Install XAMPP
echo   3. Start Apache and MySQL in XAMPP Control Panel
echo   4. Copy this project to: C:\xampp\htdocs\sams\
echo   5. Access at: http://localhost/sams/
echo.
echo OPTION 2: Download Portable PHP
echo   1. Download from: https://windows.php.net/download/
echo   2. Extract to: C:\php\
echo   3. Run this batch file again
echo.
echo ========================================
pause

