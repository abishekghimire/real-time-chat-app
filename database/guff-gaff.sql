PGDMP                      |         	   guff-gaff    16.3    16.3     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16397 	   guff-gaff    DATABASE     �   CREATE DATABASE "guff-gaff" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE "guff-gaff";
                postgres    false            �            1259    16408    messages    TABLE     �   CREATE TABLE public.messages (
    msg_id integer NOT NULL,
    incoming_msg_id bigint,
    outgoing_msg_id bigint,
    message character varying(1000)
);
    DROP TABLE public.messages;
       public         heap    postgres    false            �            1259    16407    messages_msg_id_seq    SEQUENCE     �   CREATE SEQUENCE public.messages_msg_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.messages_msg_id_seq;
       public          postgres    false    218            �           0    0    messages_msg_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.messages_msg_id_seq OWNED BY public.messages.msg_id;
          public          postgres    false    217            �            1259    16399    users    TABLE     #  CREATE TABLE public.users (
    user_id integer NOT NULL,
    unique_id integer,
    fname character varying(255),
    lname character varying(255),
    email character varying(255),
    password character varying(255),
    image character varying(400),
    status character varying(255)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16398    users_user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.users_user_id_seq;
       public          postgres    false    216            �           0    0    users_user_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;
          public          postgres    false    215            V           2604    16411    messages msg_id    DEFAULT     r   ALTER TABLE ONLY public.messages ALTER COLUMN msg_id SET DEFAULT nextval('public.messages_msg_id_seq'::regclass);
 >   ALTER TABLE public.messages ALTER COLUMN msg_id DROP DEFAULT;
       public          postgres    false    218    217    218            U           2604    16402    users user_id    DEFAULT     n   ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);
 <   ALTER TABLE public.users ALTER COLUMN user_id DROP DEFAULT;
       public          postgres    false    216    215    216            �          0    16408    messages 
   TABLE DATA           U   COPY public.messages (msg_id, incoming_msg_id, outgoing_msg_id, message) FROM stdin;
    public          postgres    false    218   
       �          0    16399    users 
   TABLE DATA           a   COPY public.users (user_id, unique_id, fname, lname, email, password, image, status) FROM stdin;
    public          postgres    false    216   '       �           0    0    messages_msg_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.messages_msg_id_seq', 17, true);
          public          postgres    false    217            �           0    0    users_user_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.users_user_id_seq', 8, true);
          public          postgres    false    215            Z           2606    16415    messages messages_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (msg_id);
 @   ALTER TABLE ONLY public.messages DROP CONSTRAINT messages_pkey;
       public            postgres    false    218            X           2606    16406    users users_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    216            �      x������ � �      �   �   x�%�;�0 �zs���0ل�:�<��$�H�#����|�q1`�q�s����ƅ��?pX��{��H1�Ӌ�}P�侏��4�>Dg��%j@��w�+���m�,3��Vyq��UWS��z|ţB� ��'1     