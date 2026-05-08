# Contrato das Views

Este arquivo documenta o que o front precisa saber para recriar as telas.

As views de login, cadastro do aluno e erro 404 continuam no projeto porque ja estao prontas:

- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/components/auth/wrapper.blade.php`
- `resources/views/components/layouts/app.blade.php`
- `resources/views/errors/404.blade.php`

As outras views foram removidas e devem ser recriadas pelo front.

## Regras gerais

- Todas as rotas web usam sessao e CSRF.
- Todo formulario `POST` precisa incluir `@csrf`.
- O logout usa `POST` em `route('authenticated.logout')`.
- Erros de validacao devem ser exibidos com `@error('campo')`.

## Login do aluno

View mantida: `resources/views/auth/login.blade.php`

Rota de exibicao:

- `GET /login`
- Nome: `login`
- Controller: `AuthController@showLogin`

Formulario:

- `POST /login`
- Nome: `login`
- Campos:
  - `email`
  - `password`

Links uteis:

- Cadastro: `route('register')`
- Login admin: `route('admin.login')`

Apos login valido:

- Redireciona para `route('authenticated.dashboard')`.

## Cadastro do aluno

View mantida: `resources/views/auth/register.blade.php`

Rota de exibicao:

- `GET /register`
- Nome: `register`
- Controller: `AuthController@showRegister`

Dados recebidos:

- `$cursos`
- Cada curso possui:
  - `$curso->id`
  - `$curso->nome`
  - `$curso->turmas`
- Cada turma possui:
  - `$turma->id`
  - `$turma->nome`
  - `$turma->curso_id`

Formulario:

- `POST /register`
- Nome: `register`
- Campos:
  - `name`
  - `email`
  - `curso_id`
  - `turma_id`
  - `password`
  - `password_confirmation`

Regras importantes:

- `turma_id` precisa pertencer ao `curso_id` selecionado.
- O front deve filtrar turmas pelo curso escolhido.

Apos cadastro valido:

- Cria o aluno.
- Faz login automaticamente.
- Redireciona para `route('authenticated.dashboard')`.

## Login admin

View esperada: `resources/views/admin/auth/login.blade.php`

Rota de exibicao:

- `GET /admin/login`
- Nome: `admin.login`
- Controller: `AdminAuthController@showLogin`

Formulario:

- `POST /admin/login`
- Nome: `admin.login.submit`
- Campos:
  - `email`
  - `password`
  - `admin_code`

Regra:

- `admin_code` atual: `UNITIMES-ADMIN`
- O usuario tambem precisa ter `is_admin = true`.

Apos login valido:

- Redireciona para `route('admin.dashboard')`.

## Dashboard do aluno

View esperada: `resources/views/authenticated/dashboard.blade.php`

Rota:

- `GET /dashboard`
- Nome: `authenticated.dashboard`
- Controller: `DashboardController@index`

Dados recebidos:

- `$user`
  - `$user->name`
  - `$user->email`
  - `$user->turma`
  - `$user->turma?->nome`
  - `$user->turma?->curso?->nome`
- `$aulas`
  - aulas apenas da turma do aluno
- `$diasSemana`
  - `segunda`
  - `terca`
  - `quarta`
  - `quinta`
  - `sexta`
  - `sabado`
- `$aulasPorDia`
  - colecao indexada pelo dia da semana
- `$faltasPorAula`
  - colecao indexada por `aula_id`
- `$totalFaltas`
- `$totalPresencas`

Cada aula possui:

- `$aula->id`
- `$aula->nome`
- `$aula->professor`
- `$aula->dia_semana`
- `$aula->horario_inicio`
- `$aula->horario_fim`
- `$aula->turma_id`

Presencas e faltas por aula:

```php
$frequencia = $faltasPorAula->get($aula->id);
$presencas = $frequencia?->presencas ?? 0;
$faltas = $frequencia?->quantidade ?? 0;
```

Acoes:

- Marcar presenca:
  - `POST route('aulas.presenca', $aula)`
- Marcar falta:
  - `POST route('aulas.falta', $aula)`

Regras:

- Aluno so pode marcar presenca/falta em aulas da propria turma.
- Se tentar marcar aula de outra turma, o backend retorna `403`.

## Dashboard admin

View esperada: `resources/views/admin/dashboard.blade.php`

Rota:

- `GET /admin/dashboard`
- Nome: `admin.dashboard`
- Controller: `Admin\DashboardController@index`

Dados recebidos:

- `$totalCursos`
- `$totalTurmas`
- `$totalAulas`
- `$totalAlunos`
- `$aulas`
  - ultimas 6 aulas cadastradas
  - carregadas com `turma.curso`

Cada aula recente possui:

- `$aula->nome`
- `$aula->professor`
- `$aula->dia_semana`
- `$aula->turma?->nome`
- `$aula->turma?->curso?->nome`

Link principal:

- Criar aula/listar aulas: `route('admin.aulas.index')`

## Gerenciamento de aulas admin

View esperada: `resources/views/admin/aulas/index.blade.php`

Rota:

- `GET /admin/aulas`
- Nome: `admin.aulas.index`
- Controller: `Admin\AulaController@index`

Dados recebidos:

- `$aulas`
  - todas as aulas, carregadas com `turma.curso`
- `$cursos`
  - todos os cursos com suas turmas

Formulario de criacao:

- `POST /admin/aulas`
- Nome: `admin.aulas.store`
- Campos:
  - `nome`
  - `professor`
  - `dia_semana`
  - `curso_id`
  - `turma_id`
  - `horario_inicio`
  - `horario_fim`

Valores aceitos em `dia_semana`:

- `segunda`
- `terca`
- `quarta`
- `quinta`
- `sexta`
- `sabado`

Regras:

- Somente admin pode criar aula.
- `turma_id` precisa pertencer ao `curso_id`.
- `horario_fim` precisa ser depois de `horario_inicio`.
- `sala`, `carga_horaria` e `limite_faltas` tem defaults no model `Aula`.

Mensagem de sucesso:

- `session('success')`

## Erro 404

View mantida: `resources/views/errors/404.blade.php`

Uso:

- Laravel renderiza automaticamente quando uma rota nao existe.

Links recomendados:

- Se autenticado: `route('authenticated.dashboard')`
- Se visitante: `route('login')`
