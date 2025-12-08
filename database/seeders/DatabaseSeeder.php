<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $permissions = [
            ['name' => 'view_imovels', 'description' => 'Permissão para visualizar vários imóveis'],
            ['name' => 'view_imovel', 'description' => 'Permissão para visualizar um imóvel'],
            ['name' => 'create_imovel', 'description' => 'Permissão para criar um imóvel'],
            ['name' => 'edit_imovel', 'description' => 'Permissão para editar um imóvel'],
            ['name' => 'delete_imovel', 'description' => 'Permissão para deletar um imóvel'],
            ['name' => 'print_imovel', 'description' => 'Permissão para imprimir um imóvel'],
            ['name' => 'view_history_imovel', 'description' => 'Permissão para visualizar vários históricos de imóveis'],
            ['name' => 'view_roles', 'description' => 'Permissão para visualizar vários roles'],
            ['name' => 'view_role', 'description' => 'Permissão para visualizar um role'],
            ['name' => 'create_role', 'description' => 'Permissão para criar um role'],
            ['name' => 'update_role', 'description' => 'Permissão para editar um role'],
            ['name' => 'delete_role', 'description' => 'Permissão para deletar um role'],
            ['name' => 'view_permissions', 'description' => 'Permissão para visualizar várias permissões'],
            ['name' => 'view_permission', 'description' => 'Permissão para visualizar uma permissão'],
            ['name' => 'create_permission', 'description' => 'Permissão para criar uma permissão'],
            ['name' => 'update_permission', 'description' => 'Permissão para editar uma permissão'],
            ['name' => 'delete_permission', 'description' => 'Permissão para deletar uma permissão'],
            ['name' => 'restore_permission', 'description' => 'Permissão para restaurar uma permissão'],
            ['name' => 'sync_permission_role', 'description' => 'Permissão para sincronizar permissões a um role'],
            ['name' => 'export_imovels', 'description' => 'Permissão para exportar imóveis para Excel'],
            ['name' => 'manage_roles', 'description' => 'Permissão para gerir perfis do sistema'],
            ['name' => 'manage_users', 'description' => 'Permissão para gerir utilizadores do sistema'],
            ['name' => 'view_users', 'description' => 'Permissão para visualizar vários utilizadores'],
            ['name' => 'view_user', 'description' => 'Permissão para visualizar um utilizador'],
            ['name' => 'create_user', 'description' => 'Permissão para criar um utilizador'],
            ['name' => 'update_user', 'description' => 'Permissão para editar um utilizador'],
            ['name' => 'delete_user', 'description' => 'Permissão para deletar um utilizador'],
        ];

        $finalidadeImovel = [
            ['nome' => 'Habitação', 'descricao' => 'Imóvel para fins residenciais', 'fator_finalidade' => 0.004],
            ['nome' => 'Comercial', 'descricao' => 'Imóvel para fins comerciais', 'fator_finalidade' => 0.007],
            ['nome' => 'Misto', 'descricao' => 'Imóvel para fins mistos (residencial e comercial)', 'fator_finalidade' => 0.007],
        ];

        $classesImovel = [
            ['nome' => 'Baixo Padrão', 'descricao' => 'Classe de Imóvel de Baixo Padrão', 'preco_m2' => 5000.00],
            ['nome' => 'Médio Padrão', 'descricao' => 'Classe de Imóvel de Médio Padrão', 'preco_m2' => 16000.00],
            ['nome' => 'Alto Padrão', 'descricao' => 'Classe de Imóvel de Alto Padrão', 'preco_m2' => 25000.00],
        ];

        $zonas = [
            ['nome' => 'Macuti', 'categoria' => 'I', 'descricao' => 'Zona de Macuti', 'fator_localizacao' => 1.13],
            ['nome' => 'Macuti-Miquejo', 'categoria' => 'II', 'descricao' => 'Zona de Macuti-Miquejo', 'fator_localizacao' => 0.89],
            ['nome' => 'Chipangara (Palmeiras I e II)', 'categoria' => 'I', 'descricao' => 'Zona de Chipangara (Palmeiras I e II)', 'fator_localizacao' => 1.13],
            ['nome' => 'Inhamudima', 'categoria' => 'III', 'descricao' => 'Zona de Inhamudima', 'fator_localizacao' => 0.79],
            ['nome' => 'Ponta Gea', 'categoria' => 'I', 'descricao' => 'Zona de Ponta Gea', 'fator_localizacao' => 1.13],
            ['nome' => 'Goto', 'categoria' => 'II', 'descricao' => 'Zona de Goto', 'fator_localizacao' => 0.89],
            ['nome' => 'Chaimite', 'categoria' => 'I', 'descricao' => 'Zona de Chaimite', 'fator_localizacao' => 1.13],
            ['nome' => 'Pioneiro', 'categoria' => 'I', 'descricao' => 'Zona de Pioneiro', 'fator_localizacao' => 1.00],
            ['nome' => 'Esturro', 'categoria' => 'I', 'descricao' => 'Zona de Esturro', 'fator_localizacao' => 1.00],
            ['nome' => 'Massamba', 'categoria' => 'III', 'descricao' => 'Zona de Massamba', 'fator_localizacao' => 0.79],
            ['nome' => 'Matacuane', 'categoria' => 'I', 'descricao' => 'Zona de Matacuane', 'fator_localizacao' => 1.00],
            ['nome' => 'Bambu', 'categoria' => 'III', 'descricao' => 'Zona de Bambu', 'fator_localizacao' => 0.79],
            ['nome' => 'Matacuane-Mesquita', 'categoria' => 'III', 'descricao' => 'Zona de Matacuane-Mesquita', 'fator_localizacao' => 0.79],
            ['nome' => 'Muchatazina', 'categoria' => 'III', 'descricao' => 'Zona de Muchatazina', 'fator_localizacao' => 0.79],
            ['nome' => 'Macurungo-Bairro', 'categoria' => 'II', 'descricao' => 'Zona de Macurungo-Bairro', 'fator_localizacao' => 0.90],
            ['nome' => 'Macurungo-Pequeno Brasil', 'categoria' => 'II', 'descricao' => 'Zona de Macurungo-Pequeno Brasil', 'fator_localizacao' => 0.90],
            ['nome' => 'Macurungo-II', 'categoria' => 'II', 'descricao' => 'Zona de Macurungo-II', 'fator_localizacao' => 0.90],
            ['nome' => 'Macurungo-Manganhe', 'categoria' => 'II', 'descricao' => 'Zona de Macurungo-Manganhe', 'fator_localizacao' => 0.90],
            ['nome' => 'Macurungo-Miquejo', 'categoria' => 'II', 'descricao' => 'Zona de Macurungo-Miquejo', 'fator_localizacao' => 0.79],
            ['nome' => 'Munhava Central', 'categoria' => 'II', 'descricao' => 'Zona de Munhava Central', 'fator_localizacao' => 0.89],
            ['nome' => 'Mavinga', 'categoria' => 'III', 'descricao' => 'Zona de Mavinga', 'fator_localizacao' => 0.79],
            ['nome' => 'Maraza', 'categoria' => 'III', 'descricao' => 'Zona de Maraza', 'fator_localizacao' => 0.79],
            ['nome' => 'Mananga', 'categoria' => 'II', 'descricao' => 'Zona de Mananga', 'fator_localizacao' => 0.79],
            ['nome' => 'Chota', 'categoria' => 'III', 'descricao' => 'Zona de Chota', 'fator_localizacao' => 0.79],
            ['nome' => 'Vaz', 'categoria' => 'III', 'descricao' => 'Zona de Vaz', 'fator_localizacao' => 0.79],
            ['nome' => 'Manga-Mascarenha', 'categoria' => 'II', 'descricao' => 'Zona de Manga Mascarenha', 'fator_localizacao' => 0.89],
            ['nome' => 'Manga Loforte', 'categoria' => 'II', 'descricao' => 'Zona de Manga Loforte', 'fator_localizacao' => 0.89],
            ['nome' => 'Muave', 'categoria' => 'III', 'descricao' => 'Zona de Muave', 'fator_localizacao' => 0.79],
            ['nome' => 'Alto da Manga', 'categoria' => 'II', 'descricao' => 'Zona de Alto da Manga', 'fator_localizacao' => 0.89],
            ['nome' => 'Nhaconjo', 'categoria' => 'II', 'descricao' => 'Zona de Nhaconjo', 'fator_localizacao' => 0.89],
            ['nome' => 'Chingussura', 'categoria' => 'II', 'descricao' => 'Zona de Chingussura', 'fator_localizacao' => 0.89],
            ['nome' => 'Massange', 'categoria' => 'III', 'descricao' => 'Zona de Massange', 'fator_localizacao' => 0.79],
            ['nome' => 'Vila Massane', 'categoria' => 'III', 'descricao' => 'Zona de Vila Massane', 'fator_localizacao' => 0.79],
            ['nome' => 'Chamba', 'categoria' => 'II', 'descricao' => 'Zona de Chamba', 'fator_localizacao' => 0.89],
            ['nome' => 'Inhamizua', 'categoria' => 'II', 'descricao' => 'Zona de Inhamizua', 'fator_localizacao' => 0.89],
            ['nome' => 'Matadouro', 'categoria' => 'III', 'descricao' => 'Zona de Matadouro', 'fator_localizacao' => 0.79],
            ['nome' => 'Ceramica', 'categoria' => 'III', 'descricao' => 'Zona de Ceramica', 'fator_localizacao' => 0.79],
            ['nome' => 'Povoa', 'categoria' => 'III', 'descricao' => 'Zona de Povoa', 'fator_localizacao' => 0.79],
            ['nome' => 'Ndunda', 'categoria' => 'III', 'descricao' => 'Zona de Ndunda', 'fator_localizacao' => 0.75],
            ['nome' => 'Mungassa', 'categoria' => 'III', 'descricao' => 'Zona de Mungassa', 'fator_localizacao' => 0.75],
            ['nome' => 'Nhangau', 'categoria' => 'III', 'descricao' => 'Zona de Nhangau', 'fator_localizacao' => 0.75],

        ];

        $tiposDocumentoIdentificacao = [

            ['nome' => 'Sem Documento', 'descricao' => 'Sem documento de identificação'],
            ['nome' => 'BI', 'descricao' => 'Bilhete de Identidade Nacional'],
            ['nome' => 'DIRE', 'descricao' => 'Documento de Identificação e Residência para Estrangeiros'],
            ['nome' => 'Passaporte', 'descricao' => 'Passaporte Nacional ou Estrangeiro'],
            ['nome' => 'Carta de Condução', 'descricao' => 'Carta de Condução'],
            ['nome' => 'Cartão de Eleitor', 'descricao' => 'Cartão de Eleitor'],
            ['nome' => 'Outro', 'descricao' => 'Outro Tipo de Documento'],
        ];
        $postosAdministrativos = [
            [
                'nome' => 'Chiveve',
                'descricao' => 'Posto Administrativo de Chiveve',
                'bairros' => [
                    ['nome' => '1º Macuti', 'descricao' => '1º Bairro - Macuti'],
                    ['nome' => '2º Chipangara', 'descricao' => '2º Bairro - Chipangara'],
                    ['nome' => '3º Ponta Gea', 'descricao' => '3º Bairro - Ponta Gea'],
                    ['nome' => '4º Chaimite', 'descricao' => '4º Bairro - Chaimite'],
                    ['nome' => '5º Pioneiro', 'descricao' => '5º Bairro - Pioneiro'],
                    ['nome' => '6º Esturro', 'descricao' => '6º Bairro - Esturro'],
                    ['nome' => '7º Matacuane', 'descricao' => '7º Bairro - Matacuane'],
                    ['nome' => '8º Macurungo', 'descricao' => '8º Bairro - Macurungo'],
                ],
            ],
            [
                'nome' => 'Munhava',
                'descricao' => 'Posto Administrativo da Munhava',
                'bairros' => [
                    ['nome' => '9º Munhava Central', 'descricao' => '9º Bairro - Munhava Central'],
                    ['nome' => '10º Mananga', 'descricao' => '10º Bairro - Mananga'],
                    ['nome' => '11º Vaz', 'descricao' => '11º Bairro - Vaz'],
                    ['nome' => '12º Maraza', 'descricao' => '12º Bairro - Maraza'],
                    ['nome' => '12Aº Chota', 'descricao' => '12Aº Bairro - Chota'],
                ],
            ],
            [
                'nome' => 'Inhamizua',
                'descricao' => 'Posto Administrativo de Inhamizua',
                'bairros' => [
                    ['nome' => '13º Alto da Manga', 'descricao' => '13º Bairro - Alto da Manga'],
                    ['nome' => '14º Nhaconjo', 'descricao' => '14º Bairro - Nhaconjo'],
                    ['nome' => '15º Chingussura', 'descricao' => '15º Bairro - Chingussura'],
                    ['nome' => '16º Vila Massane', 'descricao' => '16º Bairro - Vila Massane'],
                    ['nome' => '21º Inhamizua', 'descricao' => '21º Bairro - Inhamizua'],
                    ['nome' => '22º Matadouro', 'descricao' => '22º Bairro - Matadouro'],
                ],
            ],
            [
                'nome' => 'Manga Loforte',
                'descricao' => 'Posto Administrativo de Manga Loforte',
                'bairros' => [
                    ['nome' => '17º Mungassa', 'descricao' => '17º Bairro - Mungassa'],
                    ['nome' => '18º Ndunda', 'descricao' => '18º Bairro - Ndunda'],
                    ['nome' => '19º Manga Mascarenha', 'descricao' => '19º Bairro - Manga Mascarenha'],
                    ['nome' => '20º Muave', 'descricao' => '20º Bairro - Muave'],
                ],
            ],
            [
                'nome' => 'Nhangau',
                'descricao' => 'Posto Administrativo de Nhangau',
                'bairros' => [
                    ['nome' => '23º Nhangau', 'descricao' => '23º Bairro - Nhangau'],
                    ['nome' => '24º Tchonja', 'descricao' => '24º Bairro - Tchonja'],
                    ['nome' => '25º Nhangoma', 'descricao' => '25º Bairro - Nhangoma'],
                ],
            ],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create($permission);
        }
        foreach ($postosAdministrativos as $postoData) {
            $posto = \App\Models\PostoAdministrativo::create([
                'nome' => $postoData['nome'],
                'descricao' => $postoData['descricao'],
            ]);

            foreach ($postoData['bairros'] as $bairroData) {
                $posto->bairros()->create([
                    'nome' => $bairroData['nome'],
                    'descricao' => $bairroData['descricao'],
                ]);
            }
        }

        foreach ($tiposDocumentoIdentificacao as $tipo) {
            \App\Models\TipoDocumentoIdentificacao::create($tipo);
        }

        foreach ($zonas as $zona) {
            \App\Models\Zona::create($zona);
        }

        foreach ($classesImovel as $classe) {
            \App\Models\ClasseImovel::create($classe);
        }

        foreach ($finalidadeImovel as $finalidade) {
            \App\Models\FinalidadeImovel::create($finalidade);
        }
        $roles = array(
            ['name' => 'admin', 'description' => ' é o usuário com o mais alto nível de permissões dentro do sistema. Suas responsabilidades incluem a gestão completa da plataforma, para garantir seu funcionamento adequado e a segurança dos dados']
        );



        // regista roles iniciais do sistema
        DB::transaction(function () use ($roles) {
            Role::insert($roles);
        });

        // atribui permissoes ao role admin
        DB::transaction(function () {
            $admin = Role::where('name', 'admin')->first();
            $permission_ids =  Permission::all()->pluck('id'); // retorna a coluna id da lista de permissoes
            $userData = ['name' => 'Admin', 'email' => env('ADMIN_EMAIL'), 'role_id' => $admin->id, 'password' =>  env('ADMIN_PASSWORD')];

            // sincroniza todas permissoes existentes  ao role Admin
            $admin->permissions()->sync($permission_ids);

            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role_id' => $userData['role_id'],
                'password' => Hash::make($userData['password']),
            ]);
        });
    }
}
