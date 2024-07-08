create database produtos;
use produtos;

create table usuario(
cd_usuario int primary key auto_increment,
nm_user text,
ds_login varchar(100),
ds_senha varchar(100),
ds_imagem varchar(100),
id_usercat int
);
create table categoria(
cd_categoria int primary key auto_increment,
nm_categoria varchar(100)
);
create table usercat(
cd_usercat int primary key auto_increment,
nm_nivel char(50)
);
create table produto(
cd_produto int primary key auto_increment,
nm_produto varchar(100),
dt_fabricacao date,
ds_imagem varchar(100),
ds_produto varchar(100),
dt_vencimento date,
id_categoria int
);

alter table produto add
foreign key fk_produto_categoria(id_categoria)
references categoria(cd_categoria);

alter table usuario add
foreign key fk_usuari_usercat(id_usercat)
references usercat(cd_usercat);