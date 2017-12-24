# Laravel

##  學習紀錄

 * 用戶身份驗證與授權 auth:
	1. 個人化auth：
        + 登入成功 laravel 會為登入的人產生 remember_token
        + 登入成功導向頁面 => Http/COntrollers/Auth/LoginController
          (method優先於attribute)

        ```
        protected function redirectTo(){
            return '/loginPath';
        }
        ```

        + 登入帳號可填姓名或信箱＝> 新cover AuthenticatesUsers function

        ```
        protected function attemptLogin(Request $request)
        {
            $credentials = $this->credentials($request);
            $credentialsValue = $credentials['email'];
            unset($credentials['email']);

            $account = filter_var($credentialsValue, FILTER_VALIDATE_EMAIL)?'email':'name';
            $credentials[$account] = $credentialsValue;

            return $this->guard()->attempt(
                $credentials, $request->filled('remember')
            );
        }
        ```

        + 註冊欄位增加nickname <br>

  	2. migration:
        + 新增table(增加migrate file):

        ```
        artisan migrate:make create_table_users
        ```
        + 增加table欄位-nickname到欄位name之後：

        ```
        artisan migrate:make add_nickname_to_users
        ```

        ```
        Schema::table('users', function($table) {
            $table->integer('nick_name')->after('name');
        });
        ```

        + 修改已存在欄位的型態：</br><br>

        安裝 doctrine/dbal

        ```
        composer require doctrine/dbal </br>
        composer update
        ```

        撰寫Schema => nick_name(int) -> (varchar)

        ```
        Schema::table('users', function($table) {
           $table->string('nick_name', 50)->change();
        });
        ```













* [Markdown 教學文件](https://kingofamani.gitbooks.io/git-teach/content/chapter_6_gitbook/markdown.html)
