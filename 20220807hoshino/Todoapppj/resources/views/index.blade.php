<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div  class='Container'>
    <div class='header'>
      <h1>Todo List</h1>
      <div>
        @if (Auth::check())
        <p>{{'「'. $user->name. '」'. 'でログイン中'}}</p>
        <form class='logout' action="{{ route('logout') }}" method="POST">
          @csrf
          <input class='logout_btn'type="submit" value="ログアウト">
        </form>
        @else
        <p>ログインしてください。（<a href="/login">ログイン</a>｜
          <a href="/register">登録</a>）</p>
        @endif
      </div>
    </div>
    @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    @endif
  <form class='form' action="/todo/find" method="GET">
    @csrf
    <input class='find_btn'type="submit" value="タスク検索">
  </form>
  <form class='form' action="/todo/create" method="POST">
    @csrf
    <input class='content' type="text" name="content">
    <select class='select' name="select">
      @foreach ($Tags as $Tag)
      <option value="{{$Tag->tag}}">{{$Tag->tag}}</option>
      @endforeach
    </select>
    <input class='add_btn'type="submit" value="追加">
  </form>
  <table>
    <tr class='table_ttl'>
      <th>作成日</th>
      <th>タスク名</th>
      <th>タグ</th>
      <th>更新</th>
      <th>削除</th>
    </tr>
  @foreach ($Todos as $Todo)
  <tr class='table_content'>
    <td>
      {{$Todo->created_at}}
    </td>
      <form class='form' action="/todo/update?id={{$Todo->id}}" method="POST">
        @csrf
        <td>
          <input class='content_list' type="text" name="content" value='{{$Todo->content}}'>
        </td>
        <td>
          <select class='select' name="select">
            @foreach ($Tags as $Tag)
            @if (($Tag->id) == ($Todo->tags_id) )
            <option value="{{$Tag->tag}}" selected>{{$Tag->tag}}</option>
            @else
            <option value="{{$Tag->tag}}">{{$Tag->tag}}</option>
            @endif
            @endforeach
          </select>
        </td>
        <td>
          <button class="update_btn">更新</button>
        </td>
      </form>
      <form class='form' action="/todo/delete?id={{$Todo->id}}" method="POST">
        @csrf
        <td>
          <button class="del_btn">削除</button>
        </td>
      </form>
  </tr>
  @endforeach
  </table>
  </div>
</body>
</html>