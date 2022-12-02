PGDMP                     
    z            mbg    14.5    14.5 �   j           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            k           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            l           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            m           1262    16394    mbg    DATABASE     g   CREATE DATABASE mbg WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.1252';
    DROP DATABASE mbg;
                postgres    false            �            1259    16519    absensi_employees    TABLE     f  CREATE TABLE public.absensi_employees (
    id bigint NOT NULL,
    uuid character varying(255),
    machine_id integer,
    date_year integer,
    date_month integer,
    date_date integer,
    status character varying(255),
    cek_log character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.absensi_employees;
       public         heap    postgres    false            �            1259    16518    absensi_employees_id_seq    SEQUENCE     �   CREATE SEQUENCE public.absensi_employees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.absensi_employees_id_seq;
       public          postgres    false    229            n           0    0    absensi_employees_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.absensi_employees_id_seq OWNED BY public.absensi_employees.id;
          public          postgres    false    228            A           1259    17293    atribut_sizes    TABLE     �   CREATE TABLE public.atribut_sizes (
    id bigint NOT NULL,
    uuid character varying(255),
    size character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 !   DROP TABLE public.atribut_sizes;
       public         heap    postgres    false            @           1259    17292    atribut_sizes_id_seq    SEQUENCE     }   CREATE SEQUENCE public.atribut_sizes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.atribut_sizes_id_seq;
       public          postgres    false    321            o           0    0    atribut_sizes_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.atribut_sizes_id_seq OWNED BY public.atribut_sizes.id;
          public          postgres    false    320            �            1259    16583    brand_types    TABLE     �  CREATE TABLE public.brand_types (
    id bigint NOT NULL,
    uuid character varying(255),
    unit_uuid character varying(255),
    group_vehicle_uuid character varying(255),
    brand_uuid character varying(255),
    vehicle_hm_uuid character varying(255),
    type character varying(255),
    capacity double precision,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.brand_types;
       public         heap    postgres    false            �            1259    16582    brand_types_id_seq    SEQUENCE     {   CREATE SEQUENCE public.brand_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.brand_types_id_seq;
       public          postgres    false    243            p           0    0    brand_types_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.brand_types_id_seq OWNED BY public.brand_types.id;
          public          postgres    false    242            �            1259    16574    brands    TABLE     �   CREATE TABLE public.brands (
    id bigint NOT NULL,
    uuid character varying(255),
    brand character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.brands;
       public         heap    postgres    false            �            1259    16573    brands_id_seq    SEQUENCE     v   CREATE SEQUENCE public.brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.brands_id_seq;
       public          postgres    false    241            q           0    0    brands_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.brands_id_seq OWNED BY public.brands.id;
          public          postgres    false    240            E           1259    17321 
   coal_froms    TABLE     }  CREATE TABLE public.coal_froms (
    id bigint NOT NULL,
    uuid character varying(255),
    company_uuid character varying(255),
    coal_from character varying(255),
    hauling_price character varying(255),
    use_start date,
    use_end date,
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.coal_froms;
       public         heap    postgres    false            D           1259    17320    coal_froms_id_seq    SEQUENCE     z   CREATE SEQUENCE public.coal_froms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.coal_froms_id_seq;
       public          postgres    false    325            r           0    0    coal_froms_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.coal_froms_id_seq OWNED BY public.coal_froms.id;
          public          postgres    false    324            �            1259    16564 
   coal_types    TABLE     �   CREATE TABLE public.coal_types (
    id bigint NOT NULL,
    uuid character varying(255),
    type_name character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.coal_types;
       public         heap    postgres    false            �            1259    16563    coal_types_id_seq    SEQUENCE     z   CREATE SEQUENCE public.coal_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.coal_types_id_seq;
       public          postgres    false    239            s           0    0    coal_types_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.coal_types_id_seq OWNED BY public.coal_types.id;
          public          postgres    false    238            �            1259    16546 	   companies    TABLE     -  CREATE TABLE public.companies (
    id bigint NOT NULL,
    uuid character varying(255),
    name character varying(255),
    date_start date,
    date_end date,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    coal_type_uuid character varying(100)
);
    DROP TABLE public.companies;
       public         heap    postgres    false            �            1259    16545    companies_id_seq    SEQUENCE     y   CREATE SEQUENCE public.companies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.companies_id_seq;
       public          postgres    false    235            t           0    0    companies_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.companies_id_seq OWNED BY public.companies.id;
          public          postgres    false    234            �            1259    16528    database_statuses    TABLE     �   CREATE TABLE public.database_statuses (
    id bigint NOT NULL,
    uuid character varying(255),
    status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.database_statuses;
       public         heap    postgres    false            �            1259    16527    database_statuses_id_seq    SEQUENCE     �   CREATE SEQUENCE public.database_statuses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.database_statuses_id_seq;
       public          postgres    false    231            u           0    0    database_statuses_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.database_statuses_id_seq OWNED BY public.database_statuses.id;
          public          postgres    false    230            �            1259    16456    departments    TABLE     
  CREATE TABLE public.departments (
    id bigint NOT NULL,
    uuid character varying(255),
    department character varying(255),
    data_status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.departments;
       public         heap    postgres    false            �            1259    16455    departments_id_seq    SEQUENCE     {   CREATE SEQUENCE public.departments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.departments_id_seq;
       public          postgres    false    221            v           0    0    departments_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.departments_id_seq OWNED BY public.departments.id;
          public          postgres    false    220            1           1259    17104    employee_absens    TABLE     m  CREATE TABLE public.employee_absens (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    date date,
    status_absen_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    cek_log character varying(255),
    edited character varying(100)
);
 #   DROP TABLE public.employee_absens;
       public         heap    postgres    false            0           1259    17103    employee_absens_id_seq    SEQUENCE        CREATE SEQUENCE public.employee_absens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.employee_absens_id_seq;
       public          postgres    false    305            w           0    0    employee_absens_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.employee_absens_id_seq OWNED BY public.employee_absens.id;
          public          postgres    false    304            )           1259    16844    employee_companies    TABLE       CREATE TABLE public.employee_companies (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    company_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 &   DROP TABLE public.employee_companies;
       public         heap    postgres    false            (           1259    16843    employee_companies_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_companies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.employee_companies_id_seq;
       public          postgres    false    297            x           0    0    employee_companies_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.employee_companies_id_seq OWNED BY public.employee_companies.id;
          public          postgres    false    296            M           1259    17421    employee_hour_meter_days    TABLE     P  CREATE TABLE public.employee_hour_meter_days (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    employee_checker_uuid character varying(255),
    employee_foreman_uuid character varying(255),
    employee_supervisor_uuid character varying(255),
    hour_meter_price_uuid character varying(255),
    date date,
    shift character varying(255),
    value double precision,
    full_value double precision,
    pay_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 ,   DROP TABLE public.employee_hour_meter_days;
       public         heap    postgres    false            L           1259    17420    employee_hour_meter_days_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_hour_meter_days_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.employee_hour_meter_days_id_seq;
       public          postgres    false    333            y           0    0    employee_hour_meter_days_id_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.employee_hour_meter_days_id_seq OWNED BY public.employee_hour_meter_days.id;
          public          postgres    false    332            K           1259    17411    employee_payments    TABLE     {  CREATE TABLE public.employee_payments (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    payment_uuid character varying(255),
    value double precision,
    link_absen character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.employee_payments;
       public         heap    postgres    false            J           1259    17410    employee_payments_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.employee_payments_id_seq;
       public          postgres    false    331            z           0    0    employee_payments_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.employee_payments_id_seq OWNED BY public.employee_payments.id;
          public          postgres    false    330            '           1259    16835    employee_roasters    TABLE     `  CREATE TABLE public.employee_roasters (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    roaster_uuid character varying(255),
    date_start date,
    date_end date,
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.employee_roasters;
       public         heap    postgres    false            &           1259    16834    employee_roasters_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_roasters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.employee_roasters_id_seq;
       public          postgres    false    295            {           0    0    employee_roasters_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.employee_roasters_id_seq OWNED BY public.employee_roasters.id;
          public          postgres    false    294            %           1259    16826    employee_salaries    TABLE     �  CREATE TABLE public.employee_salaries (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    salary character varying(255),
    insentif character varying(255),
    premi_bk character varying(255),
    premi_nbk character varying(255),
    premi_kayu character varying(255),
    premi_mb character varying(255),
    premi_rj character varying(255),
    insentif_hm character varying(255),
    deposit_hm character varying(255),
    tonase character varying(255),
    date_start date,
    date_end date,
    data_status character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.employee_salaries;
       public         heap    postgres    false            $           1259    16825    employee_salaries_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_salaries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.employee_salaries_id_seq;
       public          postgres    false    293            |           0    0    employee_salaries_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.employee_salaries_id_seq OWNED BY public.employee_salaries.id;
          public          postgres    false    292            G           1259    17363    employee_tonases    TABLE     �  CREATE TABLE public.employee_tonases (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_create_uuid character varying(255),
    employee_know_uuid character varying(255),
    employee_approve_uuid character varying(255),
    vehicle_uuid character varying(255),
    employee_uuid character varying(255),
    coal_from_uuid character varying(255),
    tonase_value double precision,
    tonase_full_value double precision,
    date date,
    shift character varying(255),
    time_start date,
    time_come date,
    pay_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.employee_tonases;
       public         heap    postgres    false            F           1259    17362    employee_tonases_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_tonases_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.employee_tonases_id_seq;
       public          postgres    false    327            }           0    0    employee_tonases_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.employee_tonases_id_seq OWNED BY public.employee_tonases.id;
          public          postgres    false    326            -           1259    17045    employee_total_hm_months    TABLE     V  CREATE TABLE public.employee_total_hm_months (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    hour_meter_price_uuid character varying(255),
    value character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    month date
);
 ,   DROP TABLE public.employee_total_hm_months;
       public         heap    postgres    false            ,           1259    17044    employee_total_hm_months_id_seq    SEQUENCE     �   CREATE SEQUENCE public.employee_total_hm_months_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.employee_total_hm_months_id_seq;
       public          postgres    false    301            ~           0    0    employee_total_hm_months_id_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.employee_total_hm_months_id_seq OWNED BY public.employee_total_hm_months.id;
          public          postgres    false    300            +           1259    16853 	   employees    TABLE       CREATE TABLE public.employees (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    machine_id character varying(255),
    nik_employee character varying(255),
    position_uuid character varying(255),
    department_uuid character varying(255),
    contract_number integer,
    contract_status character varying(255),
    date_start_contract date,
    date_end_contract date,
    date_document_contract date,
    long_contract integer,
    employee_status character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    contract_number_full character varying(100),
    company_uuid character varying(255),
    file_path character varying(255)
);
    DROP TABLE public.employees;
       public         heap    postgres    false            *           1259    16852    employees_id_seq    SEQUENCE     y   CREATE SEQUENCE public.employees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.employees_id_seq;
       public          postgres    false    299                       0    0    employees_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.employees_id_seq OWNED BY public.employees.id;
          public          postgres    false    298            �            1259    16410    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    16409    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    213            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    212            7           1259    17171    galeries    TABLE     a  CREATE TABLE public.galeries (
    id bigint NOT NULL,
    uuid character varying(255),
    purchase_order_uuid character varying(255),
    title character varying(255),
    galery_path character varying(255),
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.galeries;
       public         heap    postgres    false            6           1259    17170    galeries_id_seq    SEQUENCE     x   CREATE SEQUENCE public.galeries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.galeries_id_seq;
       public          postgres    false    311            �           0    0    galeries_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.galeries_id_seq OWNED BY public.galeries.id;
          public          postgres    false    310            �            1259    16592    group_vehicles    TABLE       CREATE TABLE public.group_vehicles (
    id bigint NOT NULL,
    uuid character varying(255),
    group_code character varying(255),
    group_name character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.group_vehicles;
       public         heap    postgres    false            �            1259    16591    group_vehicles_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.group_vehicles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.group_vehicles_id_seq;
       public          postgres    false    245            �           0    0    group_vehicles_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.group_vehicles_id_seq OWNED BY public.group_vehicles.id;
          public          postgres    false    244            #           1259    16817    hauling_setups    TABLE       CREATE TABLE public.hauling_setups (
    id bigint NOT NULL,
    uuid character varying(255),
    date date,
    shift_1_employee_uuid character varying(255),
    shift_2_employee_uuid character varying(255),
    mine_uuid character varying(255),
    owner character varying(255),
    coal_type_uuid character varying(255),
    time_zone character varying(255),
    coal_from character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.hauling_setups;
       public         heap    postgres    false            "           1259    16816    hauling_setups_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.hauling_setups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.hauling_setups_id_seq;
       public          postgres    false    291            �           0    0    hauling_setups_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.hauling_setups_id_seq OWNED BY public.hauling_setups.id;
          public          postgres    false    290            !           1259    16808    haulings    TABLE     r  CREATE TABLE public.haulings (
    id bigint NOT NULL,
    uuid character varying(255),
    hauling_setup_uuid character varying(255),
    vehicle_uuid character varying(255),
    load_comes time(0) without time zone,
    load_start time(0) without time zone,
    empety_comes time(0) without time zone,
    empety_start time(0) without time zone,
    bruto character varying(255),
    tarra character varying(255),
    netto character varying(255),
    description character varying(255),
    road_permit character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.haulings;
       public         heap    postgres    false                        1259    16807    haulings_id_seq    SEQUENCE     x   CREATE SEQUENCE public.haulings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.haulings_id_seq;
       public          postgres    false    289            �           0    0    haulings_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.haulings_id_seq OWNED BY public.haulings.id;
          public          postgres    false    288            O           1259    17430    hour_meter_prices    TABLE     n  CREATE TABLE public.hour_meter_prices (
    id bigint NOT NULL,
    uuid character varying(255),
    name character varying(255),
    value double precision,
    key_excel character varying(255),
    use_start date,
    use_end date,
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.hour_meter_prices;
       public         heap    postgres    false            N           1259    17429    hour_meter_prices_id_seq    SEQUENCE     �   CREATE SEQUENCE public.hour_meter_prices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.hour_meter_prices_id_seq;
       public          postgres    false    335            �           0    0    hour_meter_prices_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.hour_meter_prices_id_seq OWNED BY public.hour_meter_prices.id;
          public          postgres    false    334                       1259    16781    hour_meters    TABLE       CREATE TABLE public.hour_meters (
    id bigint NOT NULL,
    uuid character varying(255),
    over_burden_operator_uuid character varying(255),
    hm_start double precision,
    hm_stop double precision,
    time_start time(0) without time zone,
    time_stop time(0) without time zone,
    hm_value double precision,
    hm_pay double precision,
    material character varying(255),
    description character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    datetime_checker_approve timestamp(0) without time zone[],
    datetime_foreman_approve timestamp(0) without time zone,
    datetime_supervisor_approve timestamp(0) without time zone,
    datetime_operator_approve timestamp(0) without time zone
);
    DROP TABLE public.hour_meters;
       public         heap    postgres    false                       1259    16780    hour_meters_id_seq    SEQUENCE     {   CREATE SEQUENCE public.hour_meters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.hour_meters_id_seq;
       public          postgres    false    283            �           0    0    hour_meters_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.hour_meters_id_seq OWNED BY public.hour_meters.id;
          public          postgres    false    282            �            1259    16555 	   locations    TABLE     �   CREATE TABLE public.locations (
    id bigint NOT NULL,
    uuid character varying(255),
    location character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.locations;
       public         heap    postgres    false            �            1259    16554    locations_id_seq    SEQUENCE     y   CREATE SEQUENCE public.locations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.locations_id_seq;
       public          postgres    false    237            �           0    0    locations_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.locations_id_seq OWNED BY public.locations.id;
          public          postgres    false    236            �            1259    16397 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    16396    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    210            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    209            �            1259    16501    mines    TABLE     K  CREATE TABLE public.mines (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    mine_name character varying(255),
    owner character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.mines;
       public         heap    postgres    false            �            1259    16500    mines_id_seq    SEQUENCE     u   CREATE SEQUENCE public.mines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.mines_id_seq;
       public          postgres    false    227            �           0    0    mines_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.mines_id_seq OWNED BY public.mines.id;
          public          postgres    false    226                       1259    16790    over_burden_flits    TABLE     j  CREATE TABLE public.over_burden_flits (
    id bigint NOT NULL,
    uuid character varying(255),
    over_burden_uuid character varying(255),
    operator_employee_uuid character varying(255),
    excavator_vehicle_uuid character varying(255),
    capacity integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.over_burden_flits;
       public         heap    postgres    false                       1259    16789    over_burden_flits_id_seq    SEQUENCE     �   CREATE SEQUENCE public.over_burden_flits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.over_burden_flits_id_seq;
       public          postgres    false    285            �           0    0    over_burden_flits_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.over_burden_flits_id_seq OWNED BY public.over_burden_flits.id;
          public          postgres    false    284                       1259    16763    over_burden_lists    TABLE     �  CREATE TABLE public.over_burden_lists (
    id bigint NOT NULL,
    uuid character varying(255),
    over_burden_uuid character varying(255),
    over_burden_operator_uuid character varying(255),
    over_burden_flit_uuid character varying(255),
    over_burden_capacity double precision,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    over_burden_time timestamp without time zone
);
 %   DROP TABLE public.over_burden_lists;
       public         heap    postgres    false                       1259    16762    over_burden_lists_id_seq    SEQUENCE     �   CREATE SEQUENCE public.over_burden_lists_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.over_burden_lists_id_seq;
       public          postgres    false    279            �           0    0    over_burden_lists_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.over_burden_lists_id_seq OWNED BY public.over_burden_lists.id;
          public          postgres    false    278                       1259    16799    over_burden_notes    TABLE       CREATE TABLE public.over_burden_notes (
    id bigint NOT NULL,
    uuid character varying(255),
    over_burden_uuid character varying(255),
    note character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 %   DROP TABLE public.over_burden_notes;
       public         heap    postgres    false                       1259    16798    over_burden_notes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.over_burden_notes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.over_burden_notes_id_seq;
       public          postgres    false    287            �           0    0    over_burden_notes_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.over_burden_notes_id_seq OWNED BY public.over_burden_notes.id;
          public          postgres    false    286                       1259    16772    over_burden_operators    TABLE     �  CREATE TABLE public.over_burden_operators (
    id bigint NOT NULL,
    uuid character varying(255),
    over_burden_uuid character varying(255),
    vehicle_uuid character varying(255),
    operator_employee_uuid character varying(255),
    over_burden_flit_uuid character varying(255),
    "group" character varying(255),
    capacity integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 )   DROP TABLE public.over_burden_operators;
       public         heap    postgres    false                       1259    16771    over_burden_operators_id_seq    SEQUENCE     �   CREATE SEQUENCE public.over_burden_operators_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.over_burden_operators_id_seq;
       public          postgres    false    281            �           0    0    over_burden_operators_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.over_burden_operators_id_seq OWNED BY public.over_burden_operators.id;
          public          postgres    false    280                       1259    16745    over_burdens    TABLE     �  CREATE TABLE public.over_burdens (
    id bigint NOT NULL,
    uuid character varying(255),
    foreman_employee_uuid character varying(255),
    checker_employee_uuid character varying(255),
    supervisor_employee_uuid character varying(255),
    pit_uuid character varying(255),
    date date,
    shift character varying(255),
    distance integer,
    material character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.over_burdens;
       public         heap    postgres    false                       1259    16744    over_burdens_id_seq    SEQUENCE     |   CREATE SEQUENCE public.over_burdens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.over_burdens_id_seq;
       public          postgres    false    275            �           0    0    over_burdens_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.over_burdens_id_seq OWNED BY public.over_burdens.id;
          public          postgres    false    274            �            1259    16403    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    postgres    false            3           1259    17118    payment_groups    TABLE     /  CREATE TABLE public.payment_groups (
    id bigint NOT NULL,
    uuid character varying(255),
    payment_group character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status_data character varying
);
 "   DROP TABLE public.payment_groups;
       public         heap    postgres    false            2           1259    17117    payment_groups_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.payment_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.payment_groups_id_seq;
       public          postgres    false    307            �           0    0    payment_groups_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.payment_groups_id_seq OWNED BY public.payment_groups.id;
          public          postgres    false    306            I           1259    17372    payments    TABLE     �  CREATE TABLE public.payments (
    id bigint NOT NULL,
    uuid character varying(255),
    payment_group_uuid character varying(255),
    date date,
    date_end date,
    long integer,
    employee_create_uuid character varying(255),
    employee_know_uuid character varying(255),
    employee_approve_uuid character varying(255),
    description character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.payments;
       public         heap    postgres    false            H           1259    17371    payments_id_seq    SEQUENCE     x   CREATE SEQUENCE public.payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.payments_id_seq;
       public          postgres    false    329            �           0    0    payments_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.payments_id_seq OWNED BY public.payments.id;
          public          postgres    false    328            �            1259    16422    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    16421    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    215            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    214                       1259    16754    pits    TABLE     )  CREATE TABLE public.pits (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    mine_uuid character varying(255),
    pit_name character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.pits;
       public         heap    postgres    false                       1259    16753    pits_id_seq    SEQUENCE     t   CREATE SEQUENCE public.pits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.pits_id_seq;
       public          postgres    false    277            �           0    0    pits_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.pits_id_seq OWNED BY public.pits.id;
          public          postgres    false    276            �            1259    16465    pohs    TABLE     8  CREATE TABLE public.pohs (
    id bigint NOT NULL,
    uuid character varying(255),
    name character varying(255),
    value integer,
    date_start date,
    date_end date,
    data_status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.pohs;
       public         heap    postgres    false            �            1259    16464    pohs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.pohs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.pohs_id_seq;
       public          postgres    false    223            �           0    0    pohs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.pohs_id_seq OWNED BY public.pohs.id;
          public          postgres    false    222            �            1259    16447 	   positions    TABLE       CREATE TABLE public.positions (
    id bigint NOT NULL,
    uuid character varying(255),
    "position" character varying(255),
    data_status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.positions;
       public         heap    postgres    false            �            1259    16446    positions_id_seq    SEQUENCE     y   CREATE SEQUENCE public.positions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.positions_id_seq;
       public          postgres    false    219            �           0    0    positions_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.positions_id_seq OWNED BY public.positions.id;
          public          postgres    false    218            9           1259    17195 
   privileges    TABLE       CREATE TABLE public.privileges (
    id bigint NOT NULL,
    uuid character varying(255),
    privilege character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp without time zone
);
    DROP TABLE public.privileges;
       public         heap    postgres    false            8           1259    17194    privileges_id_seq    SEQUENCE     z   CREATE SEQUENCE public.privileges_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.privileges_id_seq;
       public          postgres    false    313            �           0    0    privileges_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.privileges_id_seq OWNED BY public.privileges.id;
          public          postgres    false    312            5           1259    17162    purchase_orders    TABLE     �  CREATE TABLE public.purchase_orders (
    id bigint NOT NULL,
    uuid character varying(255),
    po_number character varying(255),
    date date,
    description character varying(255),
    travel_document_path character varying(255),
    po_path character varying(255),
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.purchase_orders;
       public         heap    postgres    false            4           1259    17161    purchase_orders_id_seq    SEQUENCE        CREATE SEQUENCE public.purchase_orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.purchase_orders_id_seq;
       public          postgres    false    309            �           0    0    purchase_orders_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.purchase_orders_id_seq OWNED BY public.purchase_orders.id;
          public          postgres    false    308            �            1259    16474 	   religions    TABLE     �   CREATE TABLE public.religions (
    id bigint NOT NULL,
    uuid character varying(255),
    religion character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.religions;
       public         heap    postgres    false            �            1259    16473    religions_id_seq    SEQUENCE     y   CREATE SEQUENCE public.religions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.religions_id_seq;
       public          postgres    false    225            �           0    0    religions_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.religions_id_seq OWNED BY public.religions.id;
          public          postgres    false    224            �            1259    16537    roasters    TABLE     #  CREATE TABLE public.roasters (
    id bigint NOT NULL,
    uuid character varying(255),
    work_day character varying(255),
    free_day character varying(255),
    name character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.roasters;
       public         heap    postgres    false            �            1259    16536    roasters_id_seq    SEQUENCE     x   CREATE SEQUENCE public.roasters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.roasters_id_seq;
       public          postgres    false    233            �           0    0    roasters_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.roasters_id_seq OWNED BY public.roasters.id;
          public          postgres    false    232            C           1259    17302    safety_employees    TABLE     ;  CREATE TABLE public.safety_employees (
    id bigint NOT NULL,
    uuid character varying(255),
    no_reg character varying(255),
    employee_uuid character varying(255),
    date date,
    end_date date,
    rompi_status character varying(255),
    rompi_date date,
    helm_color character varying(255),
    helm_date date,
    orange_size character varying(255),
    orange_date date,
    blue_size character varying(255),
    blue_date date,
    shirt_size character varying(255),
    shirt_date date,
    boots_size character varying(255),
    boots_date date,
    mekanik_size character varying(255),
    mekanik_date date,
    id_card_date date,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    no_reg_full character varying(255),
    is_last character varying(255)
);
 $   DROP TABLE public.safety_employees;
       public         heap    postgres    false            B           1259    17301    safety_employees_id_seq    SEQUENCE     �   CREATE SEQUENCE public.safety_employees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.safety_employees_id_seq;
       public          postgres    false    323            �           0    0    safety_employees_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.safety_employees_id_seq OWNED BY public.safety_employees.id;
          public          postgres    false    322            /           1259    17095    status_absens    TABLE     �  CREATE TABLE public.status_absens (
    id bigint NOT NULL,
    uuid character varying(255),
    status_absen_code character varying(255),
    status_absen_description character varying(255),
    math character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    use_start date,
    use_end date,
    is_last character varying,
    is_aktif character varying
);
 !   DROP TABLE public.status_absens;
       public         heap    postgres    false            .           1259    17094    status_absens_id_seq    SEQUENCE     }   CREATE SEQUENCE public.status_absens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.status_absens_id_seq;
       public          postgres    false    303            �           0    0    status_absens_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.status_absens_id_seq OWNED BY public.status_absens.id;
          public          postgres    false    302            �            1259    16619    statuses    TABLE     �   CREATE TABLE public.statuses (
    id bigint NOT NULL,
    uuid character varying(255),
    status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.statuses;
       public         heap    postgres    false            �            1259    16618    statuses_id_seq    SEQUENCE     x   CREATE SEQUENCE public.statuses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.statuses_id_seq;
       public          postgres    false    251            �           0    0    statuses_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.statuses_id_seq OWNED BY public.statuses.id;
          public          postgres    false    250            �            1259    16601    units    TABLE     �   CREATE TABLE public.units (
    id bigint NOT NULL,
    uuid character varying(255),
    unit character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.units;
       public         heap    postgres    false            �            1259    16600    units_id_seq    SEQUENCE     u   CREATE SEQUENCE public.units_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.units_id_seq;
       public          postgres    false    247            �           0    0    units_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.units_id_seq OWNED BY public.units.id;
          public          postgres    false    246            	           1259    16682    user_addresses    TABLE       CREATE TABLE public.user_addresses (
    id bigint NOT NULL,
    uuid character varying(255),
    poh_uuid character varying(255),
    user_detail_uuid character varying(255),
    desa character varying(255),
    rt character varying(255),
    rw character varying(255),
    kecamatan character varying(255),
    kabupaten character varying(255),
    provinsi character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.user_addresses;
       public         heap    postgres    false                       1259    16681    user_addresses_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.user_addresses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.user_addresses_id_seq;
       public          postgres    false    265            �           0    0    user_addresses_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.user_addresses_id_seq OWNED BY public.user_addresses.id;
          public          postgres    false    264            ?           1259    17222    user_dependents    TABLE     �  CREATE TABLE public.user_dependents (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    mother_name character varying(255),
    mother_gender character varying(255),
    mother_place_birth character varying(255),
    mother_date_birth date,
    mother_education character varying(255),
    father_name character varying(255),
    father_gender character varying(255),
    father_place_birth character varying(255),
    father_date_birth date,
    father_education character varying(255),
    mother_in_law_name character varying(255),
    mother_in_law_gender character varying(255),
    mother_in_law_place_birth character varying(255),
    mother_in_law_date_birth date,
    mother_in_law_education character varying(255),
    father_in_law_name character varying(255),
    father_in_law_gender character varying(255),
    father_in_law_place_birth character varying(255),
    father_in_law_date_birth date,
    father_in_law_education character varying(255),
    couple_name character varying(255),
    couple_gender character varying(255),
    couple_place_birth character varying(255),
    couple_date_birth date,
    couple_education character varying(255),
    child1_name character varying(255),
    child1_gender character varying(255),
    child1_place_birth character varying(255),
    child1_date_birth date,
    child1_education character varying(255),
    child2_name character varying(255),
    child2_gender character varying(255),
    child2_place_birth character varying(255),
    child2_date_birth date,
    child2_education character varying(255),
    child3_name character varying(255),
    child3_gender character varying(255),
    child3_place_birth character varying(255),
    child3_date_birth date,
    child3_education character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.user_dependents;
       public         heap    postgres    false            >           1259    17221    user_dependents_id_seq    SEQUENCE        CREATE SEQUENCE public.user_dependents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.user_dependents_id_seq;
       public          postgres    false    319            �           0    0    user_dependents_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.user_dependents_id_seq OWNED BY public.user_dependents.id;
          public          postgres    false    318                       1259    16673    user_details    TABLE     L  CREATE TABLE public.user_details (
    id bigint NOT NULL,
    uuid character varying(255),
    name character varying(255),
    nik_number character varying(255),
    kk_number character varying(255),
    citizenship character varying(255),
    gender character varying(255),
    place_of_birth character varying(255),
    date_of_birth date,
    blood_group character varying(255),
    status character varying(255),
    address character varying(255),
    financial_number character varying(255),
    bpjs_ketenagakerjaan character varying(255),
    bpjs_kesehatan character varying(255),
    phone_number character varying(255),
    photo_path character varying(255),
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    npwp_number character varying(255)
);
     DROP TABLE public.user_details;
       public         heap    postgres    false                       1259    16672    user_details_id_seq    SEQUENCE     |   CREATE SEQUENCE public.user_details_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.user_details_id_seq;
       public          postgres    false    263            �           0    0    user_details_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.user_details_id_seq OWNED BY public.user_details.id;
          public          postgres    false    262                       1259    16700    user_education    TABLE     E  CREATE TABLE public.user_education (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    sd_name character varying(255),
    sd_place character varying(255),
    sd_year integer,
    smp_name character varying(255),
    smp_place character varying(255),
    smp_year integer,
    sma_name character varying(255),
    sma_place character varying(255),
    sma_jurusan character varying(255),
    sma_year integer,
    ptn_name character varying(255),
    ptn_place character varying(255),
    ptn_jurusan character varying(255),
    ptn_year integer,
    dll_name character varying(255),
    dll_place character varying(255),
    dll_jurusan character varying(255),
    dll_year integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.user_education;
       public         heap    postgres    false                       1259    16699    user_education_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.user_education_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.user_education_id_seq;
       public          postgres    false    269            �           0    0    user_education_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.user_education_id_seq OWNED BY public.user_education.id;
          public          postgres    false    268                       1259    16718    user_experiences    TABLE     �  CREATE TABLE public.user_experiences (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    experience_place_name character varying(255),
    experience_position character varying(255),
    experience_date_start character varying(255),
    experience_date_end character varying(255),
    experience_reason character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.user_experiences;
       public         heap    postgres    false                       1259    16717    user_experiences_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_experiences_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.user_experiences_id_seq;
       public          postgres    false    271            �           0    0    user_experiences_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.user_experiences_id_seq OWNED BY public.user_experiences.id;
          public          postgres    false    270                       1259    16727    user_healths    TABLE     �  CREATE TABLE public.user_healths (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    name_health character varying(255),
    year character varying(255),
    health_care_place character varying(255),
    long integer,
    status_health character varying(255),
    data_status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.user_healths;
       public         heap    postgres    false                       1259    16726    user_healths_id_seq    SEQUENCE     |   CREATE SEQUENCE public.user_healths_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.user_healths_id_seq;
       public          postgres    false    273            �           0    0    user_healths_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.user_healths_id_seq OWNED BY public.user_healths.id;
          public          postgres    false    272            =           1259    17213    user_licenses    TABLE       CREATE TABLE public.user_licenses (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    sim_a character varying(255),
    sim_b1 character varying(255),
    sim_b2 character varying(255),
    sim_c character varying(255),
    sim_d character varying(255),
    sim_a_umum character varying(255),
    sim_b1_umum character varying(255),
    sim_b2_umum character varying(255),
    date_end_sim_a date,
    date_end_sim_b1 date,
    date_end_sim_b2 date,
    date_end_sim_c date,
    date_end_sim_d date,
    date_end_sim_a_umum date,
    date_end_sim_b1_umum date,
    date_end_sim_b2_umum date,
    data_status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 !   DROP TABLE public.user_licenses;
       public         heap    postgres    false            <           1259    17212    user_licenses_id_seq    SEQUENCE     }   CREATE SEQUENCE public.user_licenses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.user_licenses_id_seq;
       public          postgres    false    317            �           0    0    user_licenses_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.user_licenses_id_seq OWNED BY public.user_licenses.id;
          public          postgres    false    316            ;           1259    17204    user_privileges    TABLE       CREATE TABLE public.user_privileges (
    id bigint NOT NULL,
    uuid character varying(255),
    nik_employee character varying(255),
    privilege_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.user_privileges;
       public         heap    postgres    false            :           1259    17203    user_privileges_id_seq    SEQUENCE        CREATE SEQUENCE public.user_privileges_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.user_privileges_id_seq;
       public          postgres    false    315            �           0    0    user_privileges_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.user_privileges_id_seq OWNED BY public.user_privileges.id;
          public          postgres    false    314                       1259    16691    user_religions    TABLE       CREATE TABLE public.user_religions (
    id bigint NOT NULL,
    uuid character varying(255),
    user_detail_uuid character varying(255),
    religion_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.user_religions;
       public         heap    postgres    false            
           1259    16690    user_religions_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.user_religions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.user_religions_id_seq;
       public          postgres    false    267            �           0    0    user_religions_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.user_religions_id_seq OWNED BY public.user_religions.id;
          public          postgres    false    266            �            1259    16434    users    TABLE     ^  CREATE TABLE public.users (
    id bigint NOT NULL,
    uuid character varying(255),
    employee_uuid character varying(255),
    role character varying(255),
    nik_employee character varying(255),
    password character varying(255),
    auth_login character varying(255),
    last_login_time character varying(255),
    phone_number character varying(255),
    email character varying(255),
    photo_path character varying(255),
    facebook character varying(255),
    instagram character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16433    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    217            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    216                       1259    16646    vehicle_breakdown_details    TABLE       CREATE TABLE public.vehicle_breakdown_details (
    id bigint NOT NULL,
    uuid character varying(255),
    vehicle_uuid character varying(255),
    problem_uuid character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 -   DROP TABLE public.vehicle_breakdown_details;
       public         heap    postgres    false                        1259    16645     vehicle_breakdown_details_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vehicle_breakdown_details_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.vehicle_breakdown_details_id_seq;
       public          postgres    false    257            �           0    0     vehicle_breakdown_details_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.vehicle_breakdown_details_id_seq OWNED BY public.vehicle_breakdown_details.id;
          public          postgres    false    256            �            1259    16628    vehicle_hms    TABLE       CREATE TABLE public.vehicle_hms (
    id bigint NOT NULL,
    uuid character varying(255),
    hm_name character varying(255),
    hm_value character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.vehicle_hms;
       public         heap    postgres    false            �            1259    16627    vehicle_hms_id_seq    SEQUENCE     {   CREATE SEQUENCE public.vehicle_hms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.vehicle_hms_id_seq;
       public          postgres    false    253            �           0    0    vehicle_hms_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.vehicle_hms_id_seq OWNED BY public.vehicle_hms.id;
          public          postgres    false    252            �            1259    16637    vehicle_problems    TABLE     �   CREATE TABLE public.vehicle_problems (
    id bigint NOT NULL,
    uuid character varying(255),
    problem character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.vehicle_problems;
       public         heap    postgres    false            �            1259    16636    vehicle_problems_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vehicle_problems_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.vehicle_problems_id_seq;
       public          postgres    false    255            �           0    0    vehicle_problems_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.vehicle_problems_id_seq OWNED BY public.vehicle_problems.id;
          public          postgres    false    254                       1259    16655    vehicle_statuses    TABLE     �  CREATE TABLE public.vehicle_statuses (
    id bigint NOT NULL,
    uuid character varying(255),
    location_uuid character varying(255),
    vehicle_uuid character varying(255),
    status_uuid character varying(255),
    date_start date,
    date_end date,
    is_last character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.vehicle_statuses;
       public         heap    postgres    false                       1259    16654    vehicle_statuses_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vehicle_statuses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.vehicle_statuses_id_seq;
       public          postgres    false    259            �           0    0    vehicle_statuses_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.vehicle_statuses_id_seq OWNED BY public.vehicle_statuses.id;
          public          postgres    false    258                       1259    16664    vehicle_tracks    TABLE     �  CREATE TABLE public.vehicle_tracks (
    id bigint NOT NULL,
    uuid character varying(255),
    vehicle_uuid character varying(255),
    location_uuid character varying(255),
    hm character varying(255),
    km character varying(255),
    datetime timestamp(0) without time zone,
    is_last character(1),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 "   DROP TABLE public.vehicle_tracks;
       public         heap    postgres    false                       1259    16663    vehicle_tracks_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.vehicle_tracks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.vehicle_tracks_id_seq;
       public          postgres    false    261            �           0    0    vehicle_tracks_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.vehicle_tracks_id_seq OWNED BY public.vehicle_tracks.id;
          public          postgres    false    260            �            1259    16610    vehicles    TABLE     &  CREATE TABLE public.vehicles (
    id bigint NOT NULL,
    uuid character varying(255),
    brand_type_uuid character varying(255),
    number character varying(255),
    capacity double precision,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.vehicles;
       public         heap    postgres    false            �            1259    16609    vehicles_id_seq    SEQUENCE     x   CREATE SEQUENCE public.vehicles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.vehicles_id_seq;
       public          postgres    false    249            �           0    0    vehicles_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.vehicles_id_seq OWNED BY public.vehicles.id;
          public          postgres    false    248            �           2604    16522    absensi_employees id    DEFAULT     |   ALTER TABLE ONLY public.absensi_employees ALTER COLUMN id SET DEFAULT nextval('public.absensi_employees_id_seq'::regclass);
 C   ALTER TABLE public.absensi_employees ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    229    229            �           2604    17296    atribut_sizes id    DEFAULT     t   ALTER TABLE ONLY public.atribut_sizes ALTER COLUMN id SET DEFAULT nextval('public.atribut_sizes_id_seq'::regclass);
 ?   ALTER TABLE public.atribut_sizes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    320    321    321            �           2604    16586    brand_types id    DEFAULT     p   ALTER TABLE ONLY public.brand_types ALTER COLUMN id SET DEFAULT nextval('public.brand_types_id_seq'::regclass);
 =   ALTER TABLE public.brand_types ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    243    242    243            �           2604    16577 	   brands id    DEFAULT     f   ALTER TABLE ONLY public.brands ALTER COLUMN id SET DEFAULT nextval('public.brands_id_seq'::regclass);
 8   ALTER TABLE public.brands ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    240    241    241            �           2604    17324    coal_froms id    DEFAULT     n   ALTER TABLE ONLY public.coal_froms ALTER COLUMN id SET DEFAULT nextval('public.coal_froms_id_seq'::regclass);
 <   ALTER TABLE public.coal_froms ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    324    325    325            �           2604    16567    coal_types id    DEFAULT     n   ALTER TABLE ONLY public.coal_types ALTER COLUMN id SET DEFAULT nextval('public.coal_types_id_seq'::regclass);
 <   ALTER TABLE public.coal_types ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    238    239    239            �           2604    16549    companies id    DEFAULT     l   ALTER TABLE ONLY public.companies ALTER COLUMN id SET DEFAULT nextval('public.companies_id_seq'::regclass);
 ;   ALTER TABLE public.companies ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    234    235    235            �           2604    16531    database_statuses id    DEFAULT     |   ALTER TABLE ONLY public.database_statuses ALTER COLUMN id SET DEFAULT nextval('public.database_statuses_id_seq'::regclass);
 C   ALTER TABLE public.database_statuses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    230    231            �           2604    16459    departments id    DEFAULT     p   ALTER TABLE ONLY public.departments ALTER COLUMN id SET DEFAULT nextval('public.departments_id_seq'::regclass);
 =   ALTER TABLE public.departments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    220    221            �           2604    17107    employee_absens id    DEFAULT     x   ALTER TABLE ONLY public.employee_absens ALTER COLUMN id SET DEFAULT nextval('public.employee_absens_id_seq'::regclass);
 A   ALTER TABLE public.employee_absens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    305    304    305            �           2604    16847    employee_companies id    DEFAULT     ~   ALTER TABLE ONLY public.employee_companies ALTER COLUMN id SET DEFAULT nextval('public.employee_companies_id_seq'::regclass);
 D   ALTER TABLE public.employee_companies ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    296    297    297            �           2604    17424    employee_hour_meter_days id    DEFAULT     �   ALTER TABLE ONLY public.employee_hour_meter_days ALTER COLUMN id SET DEFAULT nextval('public.employee_hour_meter_days_id_seq'::regclass);
 J   ALTER TABLE public.employee_hour_meter_days ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    332    333    333            �           2604    17414    employee_payments id    DEFAULT     |   ALTER TABLE ONLY public.employee_payments ALTER COLUMN id SET DEFAULT nextval('public.employee_payments_id_seq'::regclass);
 C   ALTER TABLE public.employee_payments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    331    330    331            �           2604    16838    employee_roasters id    DEFAULT     |   ALTER TABLE ONLY public.employee_roasters ALTER COLUMN id SET DEFAULT nextval('public.employee_roasters_id_seq'::regclass);
 C   ALTER TABLE public.employee_roasters ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    294    295    295            �           2604    16829    employee_salaries id    DEFAULT     |   ALTER TABLE ONLY public.employee_salaries ALTER COLUMN id SET DEFAULT nextval('public.employee_salaries_id_seq'::regclass);
 C   ALTER TABLE public.employee_salaries ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    292    293    293            �           2604    17366    employee_tonases id    DEFAULT     z   ALTER TABLE ONLY public.employee_tonases ALTER COLUMN id SET DEFAULT nextval('public.employee_tonases_id_seq'::regclass);
 B   ALTER TABLE public.employee_tonases ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    327    326    327            �           2604    17048    employee_total_hm_months id    DEFAULT     �   ALTER TABLE ONLY public.employee_total_hm_months ALTER COLUMN id SET DEFAULT nextval('public.employee_total_hm_months_id_seq'::regclass);
 J   ALTER TABLE public.employee_total_hm_months ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    300    301    301            �           2604    16856    employees id    DEFAULT     l   ALTER TABLE ONLY public.employees ALTER COLUMN id SET DEFAULT nextval('public.employees_id_seq'::regclass);
 ;   ALTER TABLE public.employees ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    299    298    299            �           2604    16413    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    213    212    213            �           2604    17174    galeries id    DEFAULT     j   ALTER TABLE ONLY public.galeries ALTER COLUMN id SET DEFAULT nextval('public.galeries_id_seq'::regclass);
 :   ALTER TABLE public.galeries ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    310    311    311            �           2604    16595    group_vehicles id    DEFAULT     v   ALTER TABLE ONLY public.group_vehicles ALTER COLUMN id SET DEFAULT nextval('public.group_vehicles_id_seq'::regclass);
 @   ALTER TABLE public.group_vehicles ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    245    244    245            �           2604    16820    hauling_setups id    DEFAULT     v   ALTER TABLE ONLY public.hauling_setups ALTER COLUMN id SET DEFAULT nextval('public.hauling_setups_id_seq'::regclass);
 @   ALTER TABLE public.hauling_setups ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    290    291    291            �           2604    16811    haulings id    DEFAULT     j   ALTER TABLE ONLY public.haulings ALTER COLUMN id SET DEFAULT nextval('public.haulings_id_seq'::regclass);
 :   ALTER TABLE public.haulings ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    288    289    289            �           2604    17433    hour_meter_prices id    DEFAULT     |   ALTER TABLE ONLY public.hour_meter_prices ALTER COLUMN id SET DEFAULT nextval('public.hour_meter_prices_id_seq'::regclass);
 C   ALTER TABLE public.hour_meter_prices ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    334    335    335            �           2604    16784    hour_meters id    DEFAULT     p   ALTER TABLE ONLY public.hour_meters ALTER COLUMN id SET DEFAULT nextval('public.hour_meters_id_seq'::regclass);
 =   ALTER TABLE public.hour_meters ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    282    283    283            �           2604    16558    locations id    DEFAULT     l   ALTER TABLE ONLY public.locations ALTER COLUMN id SET DEFAULT nextval('public.locations_id_seq'::regclass);
 ;   ALTER TABLE public.locations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    237    236    237            �           2604    16400    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    210    209    210            �           2604    16504    mines id    DEFAULT     d   ALTER TABLE ONLY public.mines ALTER COLUMN id SET DEFAULT nextval('public.mines_id_seq'::regclass);
 7   ALTER TABLE public.mines ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226    227            �           2604    16793    over_burden_flits id    DEFAULT     |   ALTER TABLE ONLY public.over_burden_flits ALTER COLUMN id SET DEFAULT nextval('public.over_burden_flits_id_seq'::regclass);
 C   ALTER TABLE public.over_burden_flits ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    284    285    285            �           2604    16766    over_burden_lists id    DEFAULT     |   ALTER TABLE ONLY public.over_burden_lists ALTER COLUMN id SET DEFAULT nextval('public.over_burden_lists_id_seq'::regclass);
 C   ALTER TABLE public.over_burden_lists ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    278    279    279            �           2604    16802    over_burden_notes id    DEFAULT     |   ALTER TABLE ONLY public.over_burden_notes ALTER COLUMN id SET DEFAULT nextval('public.over_burden_notes_id_seq'::regclass);
 C   ALTER TABLE public.over_burden_notes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    286    287    287            �           2604    16775    over_burden_operators id    DEFAULT     �   ALTER TABLE ONLY public.over_burden_operators ALTER COLUMN id SET DEFAULT nextval('public.over_burden_operators_id_seq'::regclass);
 G   ALTER TABLE public.over_burden_operators ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    281    280    281            �           2604    16748    over_burdens id    DEFAULT     r   ALTER TABLE ONLY public.over_burdens ALTER COLUMN id SET DEFAULT nextval('public.over_burdens_id_seq'::regclass);
 >   ALTER TABLE public.over_burdens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    275    274    275            �           2604    17121    payment_groups id    DEFAULT     v   ALTER TABLE ONLY public.payment_groups ALTER COLUMN id SET DEFAULT nextval('public.payment_groups_id_seq'::regclass);
 @   ALTER TABLE public.payment_groups ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    307    306    307            �           2604    17375    payments id    DEFAULT     j   ALTER TABLE ONLY public.payments ALTER COLUMN id SET DEFAULT nextval('public.payments_id_seq'::regclass);
 :   ALTER TABLE public.payments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    329    328    329            �           2604    16425    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214    215            �           2604    16757    pits id    DEFAULT     b   ALTER TABLE ONLY public.pits ALTER COLUMN id SET DEFAULT nextval('public.pits_id_seq'::regclass);
 6   ALTER TABLE public.pits ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    277    276    277            �           2604    16468    pohs id    DEFAULT     b   ALTER TABLE ONLY public.pohs ALTER COLUMN id SET DEFAULT nextval('public.pohs_id_seq'::regclass);
 6   ALTER TABLE public.pohs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222    223            �           2604    16450    positions id    DEFAULT     l   ALTER TABLE ONLY public.positions ALTER COLUMN id SET DEFAULT nextval('public.positions_id_seq'::regclass);
 ;   ALTER TABLE public.positions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218    219            �           2604    17198    privileges id    DEFAULT     n   ALTER TABLE ONLY public.privileges ALTER COLUMN id SET DEFAULT nextval('public.privileges_id_seq'::regclass);
 <   ALTER TABLE public.privileges ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    312    313    313            �           2604    17165    purchase_orders id    DEFAULT     x   ALTER TABLE ONLY public.purchase_orders ALTER COLUMN id SET DEFAULT nextval('public.purchase_orders_id_seq'::regclass);
 A   ALTER TABLE public.purchase_orders ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    308    309    309            �           2604    16477    religions id    DEFAULT     l   ALTER TABLE ONLY public.religions ALTER COLUMN id SET DEFAULT nextval('public.religions_id_seq'::regclass);
 ;   ALTER TABLE public.religions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224    225            �           2604    16540    roasters id    DEFAULT     j   ALTER TABLE ONLY public.roasters ALTER COLUMN id SET DEFAULT nextval('public.roasters_id_seq'::regclass);
 :   ALTER TABLE public.roasters ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    233    232    233            �           2604    17305    safety_employees id    DEFAULT     z   ALTER TABLE ONLY public.safety_employees ALTER COLUMN id SET DEFAULT nextval('public.safety_employees_id_seq'::regclass);
 B   ALTER TABLE public.safety_employees ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    322    323    323            �           2604    17098    status_absens id    DEFAULT     t   ALTER TABLE ONLY public.status_absens ALTER COLUMN id SET DEFAULT nextval('public.status_absens_id_seq'::regclass);
 ?   ALTER TABLE public.status_absens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    303    302    303            �           2604    16622    statuses id    DEFAULT     j   ALTER TABLE ONLY public.statuses ALTER COLUMN id SET DEFAULT nextval('public.statuses_id_seq'::regclass);
 :   ALTER TABLE public.statuses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    250    251    251            �           2604    16604    units id    DEFAULT     d   ALTER TABLE ONLY public.units ALTER COLUMN id SET DEFAULT nextval('public.units_id_seq'::regclass);
 7   ALTER TABLE public.units ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    246    247    247            �           2604    16685    user_addresses id    DEFAULT     v   ALTER TABLE ONLY public.user_addresses ALTER COLUMN id SET DEFAULT nextval('public.user_addresses_id_seq'::regclass);
 @   ALTER TABLE public.user_addresses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    265    264    265            �           2604    17225    user_dependents id    DEFAULT     x   ALTER TABLE ONLY public.user_dependents ALTER COLUMN id SET DEFAULT nextval('public.user_dependents_id_seq'::regclass);
 A   ALTER TABLE public.user_dependents ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    318    319    319            �           2604    16676    user_details id    DEFAULT     r   ALTER TABLE ONLY public.user_details ALTER COLUMN id SET DEFAULT nextval('public.user_details_id_seq'::regclass);
 >   ALTER TABLE public.user_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    263    262    263            �           2604    16703    user_education id    DEFAULT     v   ALTER TABLE ONLY public.user_education ALTER COLUMN id SET DEFAULT nextval('public.user_education_id_seq'::regclass);
 @   ALTER TABLE public.user_education ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    268    269    269            �           2604    16721    user_experiences id    DEFAULT     z   ALTER TABLE ONLY public.user_experiences ALTER COLUMN id SET DEFAULT nextval('public.user_experiences_id_seq'::regclass);
 B   ALTER TABLE public.user_experiences ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    271    270    271            �           2604    16730    user_healths id    DEFAULT     r   ALTER TABLE ONLY public.user_healths ALTER COLUMN id SET DEFAULT nextval('public.user_healths_id_seq'::regclass);
 >   ALTER TABLE public.user_healths ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    273    272    273            �           2604    17216    user_licenses id    DEFAULT     t   ALTER TABLE ONLY public.user_licenses ALTER COLUMN id SET DEFAULT nextval('public.user_licenses_id_seq'::regclass);
 ?   ALTER TABLE public.user_licenses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    316    317    317            �           2604    17207    user_privileges id    DEFAULT     x   ALTER TABLE ONLY public.user_privileges ALTER COLUMN id SET DEFAULT nextval('public.user_privileges_id_seq'::regclass);
 A   ALTER TABLE public.user_privileges ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    315    314    315            �           2604    16694    user_religions id    DEFAULT     v   ALTER TABLE ONLY public.user_religions ALTER COLUMN id SET DEFAULT nextval('public.user_religions_id_seq'::regclass);
 @   ALTER TABLE public.user_religions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    266    267    267            �           2604    16437    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216    217            �           2604    16649    vehicle_breakdown_details id    DEFAULT     �   ALTER TABLE ONLY public.vehicle_breakdown_details ALTER COLUMN id SET DEFAULT nextval('public.vehicle_breakdown_details_id_seq'::regclass);
 K   ALTER TABLE public.vehicle_breakdown_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    256    257    257            �           2604    16631    vehicle_hms id    DEFAULT     p   ALTER TABLE ONLY public.vehicle_hms ALTER COLUMN id SET DEFAULT nextval('public.vehicle_hms_id_seq'::regclass);
 =   ALTER TABLE public.vehicle_hms ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    253    252    253            �           2604    16640    vehicle_problems id    DEFAULT     z   ALTER TABLE ONLY public.vehicle_problems ALTER COLUMN id SET DEFAULT nextval('public.vehicle_problems_id_seq'::regclass);
 B   ALTER TABLE public.vehicle_problems ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    255    254    255            �           2604    16658    vehicle_statuses id    DEFAULT     z   ALTER TABLE ONLY public.vehicle_statuses ALTER COLUMN id SET DEFAULT nextval('public.vehicle_statuses_id_seq'::regclass);
 B   ALTER TABLE public.vehicle_statuses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    258    259    259            �           2604    16667    vehicle_tracks id    DEFAULT     v   ALTER TABLE ONLY public.vehicle_tracks ALTER COLUMN id SET DEFAULT nextval('public.vehicle_tracks_id_seq'::regclass);
 @   ALTER TABLE public.vehicle_tracks ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    260    261    261            �           2604    16613    vehicles id    DEFAULT     j   ALTER TABLE ONLY public.vehicles ALTER COLUMN id SET DEFAULT nextval('public.vehicles_id_seq'::regclass);
 :   ALTER TABLE public.vehicles ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    249    248    249            �          0    16519    absensi_employees 
   TABLE DATA           �   COPY public.absensi_employees (id, uuid, machine_id, date_year, date_month, date_date, status, cek_log, created_at, updated_at) FROM stdin;
    public          postgres    false    229   �O      Y          0    17293    atribut_sizes 
   TABLE DATA           O   COPY public.atribut_sizes (id, uuid, size, created_at, updated_at) FROM stdin;
    public          postgres    false    321   �O                0    16583    brand_types 
   TABLE DATA           �   COPY public.brand_types (id, uuid, unit_uuid, group_vehicle_uuid, brand_uuid, vehicle_hm_uuid, type, capacity, created_at, updated_at) FROM stdin;
    public          postgres    false    243   UP      	          0    16574    brands 
   TABLE DATA           I   COPY public.brands (id, uuid, brand, created_at, updated_at) FROM stdin;
    public          postgres    false    241   xX      ]          0    17321 
   coal_froms 
   TABLE DATA           �   COPY public.coal_froms (id, uuid, company_uuid, coal_from, hauling_price, use_start, use_end, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    325   �Y                0    16564 
   coal_types 
   TABLE DATA           Q   COPY public.coal_types (id, uuid, type_name, created_at, updated_at) FROM stdin;
    public          postgres    false    239   �Z                0    16546 	   companies 
   TABLE DATA           q   COPY public.companies (id, uuid, name, date_start, date_end, created_at, updated_at, coal_type_uuid) FROM stdin;
    public          postgres    false    235   �Z      �          0    16528    database_statuses 
   TABLE DATA           U   COPY public.database_statuses (id, uuid, status, created_at, updated_at) FROM stdin;
    public          postgres    false    231   �[      �          0    16456    departments 
   TABLE DATA           `   COPY public.departments (id, uuid, department, data_status, created_at, updated_at) FROM stdin;
    public          postgres    false    221   �[      I          0    17104    employee_absens 
   TABLE DATA           �   COPY public.employee_absens (id, uuid, employee_uuid, date, status_absen_uuid, created_at, updated_at, cek_log, edited) FROM stdin;
    public          postgres    false    305   2]      A          0    16844    employee_companies 
   TABLE DATA           k   COPY public.employee_companies (id, uuid, employee_uuid, company_uuid, created_at, updated_at) FROM stdin;
    public          postgres    false    297    �      e          0    17421    employee_hour_meter_days 
   TABLE DATA           �   COPY public.employee_hour_meter_days (id, uuid, employee_uuid, employee_checker_uuid, employee_foreman_uuid, employee_supervisor_uuid, hour_meter_price_uuid, date, shift, value, full_value, pay_uuid, created_at, updated_at) FROM stdin;
    public          postgres    false    333   ��      c          0    17411    employee_payments 
   TABLE DATA           �   COPY public.employee_payments (id, uuid, employee_uuid, payment_uuid, value, link_absen, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    331   m�      ?          0    16835    employee_roasters 
   TABLE DATA           �   COPY public.employee_roasters (id, uuid, employee_uuid, roaster_uuid, date_start, date_end, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    295   v�      =          0    16826    employee_salaries 
   TABLE DATA           �   COPY public.employee_salaries (id, uuid, employee_uuid, salary, insentif, premi_bk, premi_nbk, premi_kayu, premi_mb, premi_rj, insentif_hm, deposit_hm, tonase, date_start, date_end, data_status, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    293   ��      _          0    17363    employee_tonases 
   TABLE DATA           	  COPY public.employee_tonases (id, uuid, employee_create_uuid, employee_know_uuid, employee_approve_uuid, vehicle_uuid, employee_uuid, coal_from_uuid, tonase_value, tonase_full_value, date, shift, time_start, time_come, pay_uuid, created_at, updated_at) FROM stdin;
    public          postgres    false    327   ��      E          0    17045    employee_total_hm_months 
   TABLE DATA           �   COPY public.employee_total_hm_months (id, uuid, employee_uuid, hour_meter_price_uuid, value, created_at, updated_at, month) FROM stdin;
    public          postgres    false    301   l�      C          0    16853 	   employees 
   TABLE DATA           K  COPY public.employees (id, uuid, user_detail_uuid, machine_id, nik_employee, position_uuid, department_uuid, contract_number, contract_status, date_start_contract, date_end_contract, date_document_contract, long_contract, employee_status, is_last, created_at, updated_at, contract_number_full, company_uuid, file_path) FROM stdin;
    public          postgres    false    299   C�      �          0    16410    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    213         O          0    17171    galeries 
   TABLE DATA           y   COPY public.galeries (id, uuid, purchase_order_uuid, title, galery_path, deleted_at, created_at, updated_at) FROM stdin;
    public          postgres    false    311   2                0    16592    group_vehicles 
   TABLE DATA           b   COPY public.group_vehicles (id, uuid, group_code, group_name, created_at, updated_at) FROM stdin;
    public          postgres    false    245   Y      ;          0    16817    hauling_setups 
   TABLE DATA           �   COPY public.hauling_setups (id, uuid, date, shift_1_employee_uuid, shift_2_employee_uuid, mine_uuid, owner, coal_type_uuid, time_zone, coal_from, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    291   �      9          0    16808    haulings 
   TABLE DATA           �   COPY public.haulings (id, uuid, hauling_setup_uuid, vehicle_uuid, load_comes, load_start, empety_comes, empety_start, bruto, tarra, netto, description, road_permit, created_at, updated_at) FROM stdin;
    public          postgres    false    289   �      g          0    17430    hour_meter_prices 
   TABLE DATA           �   COPY public.hour_meter_prices (id, uuid, name, value, key_excel, use_start, use_end, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    335         3          0    16781    hour_meters 
   TABLE DATA           !  COPY public.hour_meters (id, uuid, over_burden_operator_uuid, hm_start, hm_stop, time_start, time_stop, hm_value, hm_pay, material, description, created_at, updated_at, datetime_checker_approve, datetime_foreman_approve, datetime_supervisor_approve, datetime_operator_approve) FROM stdin;
    public          postgres    false    283   �                0    16555 	   locations 
   TABLE DATA           O   COPY public.locations (id, uuid, location, created_at, updated_at) FROM stdin;
    public          postgres    false    237   �      �          0    16397 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    210   _      �          0    16501    mines 
   TABLE DATA           k   COPY public.mines (id, uuid, employee_uuid, mine_name, owner, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    227   2      5          0    16790    over_burden_flits 
   TABLE DATA           �   COPY public.over_burden_flits (id, uuid, over_burden_uuid, operator_employee_uuid, excavator_vehicle_uuid, capacity, created_at, updated_at) FROM stdin;
    public          postgres    false    285   �      /          0    16763    over_burden_lists 
   TABLE DATA           �   COPY public.over_burden_lists (id, uuid, over_burden_uuid, over_burden_operator_uuid, over_burden_flit_uuid, over_burden_capacity, created_at, updated_at, over_burden_time) FROM stdin;
    public          postgres    false    279   �      7          0    16799    over_burden_notes 
   TABLE DATA           e   COPY public.over_burden_notes (id, uuid, over_burden_uuid, note, created_at, updated_at) FROM stdin;
    public          postgres    false    287   �!      1          0    16772    over_burden_operators 
   TABLE DATA           �   COPY public.over_burden_operators (id, uuid, over_burden_uuid, vehicle_uuid, operator_employee_uuid, over_burden_flit_uuid, "group", capacity, created_at, updated_at) FROM stdin;
    public          postgres    false    281   �"      +          0    16745    over_burdens 
   TABLE DATA           �   COPY public.over_burdens (id, uuid, foreman_employee_uuid, checker_employee_uuid, supervisor_employee_uuid, pit_uuid, date, shift, distance, material, created_at, updated_at) FROM stdin;
    public          postgres    false    275   �'      �          0    16403    password_resets 
   TABLE DATA           C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public          postgres    false    211   ?)      K          0    17118    payment_groups 
   TABLE DATA           o   COPY public.payment_groups (id, uuid, payment_group, is_last, created_at, updated_at, status_data) FROM stdin;
    public          postgres    false    307   \)      a          0    17372    payments 
   TABLE DATA           �   COPY public.payments (id, uuid, payment_group_uuid, date, date_end, long, employee_create_uuid, employee_know_uuid, employee_approve_uuid, description, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    329   �)      �          0    16422    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
    public          postgres    false    215   �*      -          0    16754    pits 
   TABLE DATA           d   COPY public.pits (id, uuid, employee_uuid, mine_uuid, pit_name, created_at, updated_at) FROM stdin;
    public          postgres    false    277   �*      �          0    16465    pohs 
   TABLE DATA           p   COPY public.pohs (id, uuid, name, value, date_start, date_end, data_status, created_at, updated_at) FROM stdin;
    public          postgres    false    223   R+      �          0    16447 	   positions 
   TABLE DATA           ^   COPY public.positions (id, uuid, "position", data_status, created_at, updated_at) FROM stdin;
    public          postgres    false    219   �+      Q          0    17195 
   privileges 
   TABLE DATA           ]   COPY public.privileges (id, uuid, privilege, created_at, updated_at, deleted_at) FROM stdin;
    public          postgres    false    313   )3      M          0    17162    purchase_orders 
   TABLE DATA           �   COPY public.purchase_orders (id, uuid, po_number, date, description, travel_document_path, po_path, deleted_at, created_at, updated_at) FROM stdin;
    public          postgres    false    309   �5      �          0    16474 	   religions 
   TABLE DATA           O   COPY public.religions (id, uuid, religion, created_at, updated_at) FROM stdin;
    public          postgres    false    225   �:                0    16537    roasters 
   TABLE DATA           ^   COPY public.roasters (id, uuid, work_day, free_day, name, created_at, updated_at) FROM stdin;
    public          postgres    false    233   E;      [          0    17302    safety_employees 
   TABLE DATA           D  COPY public.safety_employees (id, uuid, no_reg, employee_uuid, date, end_date, rompi_status, rompi_date, helm_color, helm_date, orange_size, orange_date, blue_size, blue_date, shirt_size, shirt_date, boots_size, boots_date, mekanik_size, mekanik_date, id_card_date, created_at, updated_at, no_reg_full, is_last) FROM stdin;
    public          postgres    false    323   �;      G          0    17095    status_absens 
   TABLE DATA           �   COPY public.status_absens (id, uuid, status_absen_code, status_absen_description, math, created_at, updated_at, use_start, use_end, is_last, is_aktif) FROM stdin;
    public          postgres    false    303   �<                0    16619    statuses 
   TABLE DATA           L   COPY public.statuses (id, uuid, status, created_at, updated_at) FROM stdin;
    public          postgres    false    251   �=                0    16601    units 
   TABLE DATA           G   COPY public.units (id, uuid, unit, created_at, updated_at) FROM stdin;
    public          postgres    false    247   >      !          0    16682    user_addresses 
   TABLE DATA           �   COPY public.user_addresses (id, uuid, poh_uuid, user_detail_uuid, desa, rt, rw, kecamatan, kabupaten, provinsi, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    265   _>      W          0    17222    user_dependents 
   TABLE DATA           K  COPY public.user_dependents (id, uuid, user_detail_uuid, mother_name, mother_gender, mother_place_birth, mother_date_birth, mother_education, father_name, father_gender, father_place_birth, father_date_birth, father_education, mother_in_law_name, mother_in_law_gender, mother_in_law_place_birth, mother_in_law_date_birth, mother_in_law_education, father_in_law_name, father_in_law_gender, father_in_law_place_birth, father_in_law_date_birth, father_in_law_education, couple_name, couple_gender, couple_place_birth, couple_date_birth, couple_education, child1_name, child1_gender, child1_place_birth, child1_date_birth, child1_education, child2_name, child2_gender, child2_place_birth, child2_date_birth, child2_education, child3_name, child3_gender, child3_place_birth, child3_date_birth, child3_education, created_at, updated_at) FROM stdin;
    public          postgres    false    319   ؊                0    16673    user_details 
   TABLE DATA             COPY public.user_details (id, uuid, name, nik_number, kk_number, citizenship, gender, place_of_birth, date_of_birth, blood_group, status, address, financial_number, bpjs_ketenagakerjaan, bpjs_kesehatan, phone_number, photo_path, is_last, created_at, updated_at, npwp_number) FROM stdin;
    public          postgres    false    263   '�      %          0    16700    user_education 
   TABLE DATA             COPY public.user_education (id, uuid, user_detail_uuid, sd_name, sd_place, sd_year, smp_name, smp_place, smp_year, sma_name, sma_place, sma_jurusan, sma_year, ptn_name, ptn_place, ptn_jurusan, ptn_year, dll_name, dll_place, dll_jurusan, dll_year, created_at, updated_at) FROM stdin;
    public          postgres    false    269   õ      '          0    16718    user_experiences 
   TABLE DATA           �   COPY public.user_experiences (id, uuid, user_detail_uuid, experience_place_name, experience_position, experience_date_start, experience_date_end, experience_reason, created_at, updated_at) FROM stdin;
    public          postgres    false    271   u�      )          0    16727    user_healths 
   TABLE DATA           �   COPY public.user_healths (id, uuid, user_detail_uuid, name_health, year, health_care_place, long, status_health, data_status, created_at, updated_at) FROM stdin;
    public          postgres    false    273   �      U          0    17213    user_licenses 
   TABLE DATA           F  COPY public.user_licenses (id, uuid, user_detail_uuid, sim_a, sim_b1, sim_b2, sim_c, sim_d, sim_a_umum, sim_b1_umum, sim_b2_umum, date_end_sim_a, date_end_sim_b1, date_end_sim_b2, date_end_sim_c, date_end_sim_d, date_end_sim_a_umum, date_end_sim_b1_umum, date_end_sim_b2_umum, data_status, created_at, updated_at) FROM stdin;
    public          postgres    false    317   ��      S          0    17204    user_privileges 
   TABLE DATA           i   COPY public.user_privileges (id, uuid, nik_employee, privilege_uuid, created_at, updated_at) FROM stdin;
    public          postgres    false    315   ��      #          0    16691    user_religions 
   TABLE DATA           k   COPY public.user_religions (id, uuid, user_detail_uuid, religion_uuid, created_at, updated_at) FROM stdin;
    public          postgres    false    267   ��      �          0    16434    users 
   TABLE DATA           �   COPY public.users (id, uuid, employee_uuid, role, nik_employee, password, auth_login, last_login_time, phone_number, email, photo_path, facebook, instagram, created_at, updated_at) FROM stdin;
    public          postgres    false    217   ��                0    16646    vehicle_breakdown_details 
   TABLE DATA           q   COPY public.vehicle_breakdown_details (id, uuid, vehicle_uuid, problem_uuid, created_at, updated_at) FROM stdin;
    public          postgres    false    257   ��                0    16628    vehicle_hms 
   TABLE DATA           Z   COPY public.vehicle_hms (id, uuid, hm_name, hm_value, created_at, updated_at) FROM stdin;
    public          postgres    false    253   ��                0    16637    vehicle_problems 
   TABLE DATA           U   COPY public.vehicle_problems (id, uuid, problem, created_at, updated_at) FROM stdin;
    public          postgres    false    255   >�                0    16655    vehicle_statuses 
   TABLE DATA           �   COPY public.vehicle_statuses (id, uuid, location_uuid, vehicle_uuid, status_uuid, date_start, date_end, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    259   [�                0    16664    vehicle_tracks 
   TABLE DATA           �   COPY public.vehicle_tracks (id, uuid, vehicle_uuid, location_uuid, hm, km, datetime, is_last, created_at, updated_at) FROM stdin;
    public          postgres    false    261   4�                0    16610    vehicles 
   TABLE DATA           g   COPY public.vehicles (id, uuid, brand_type_uuid, number, capacity, created_at, updated_at) FROM stdin;
    public          postgres    false    249   �      �           0    0    absensi_employees_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.absensi_employees_id_seq', 1, false);
          public          postgres    false    228            �           0    0    atribut_sizes_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.atribut_sizes_id_seq', 21, true);
          public          postgres    false    320            �           0    0    brand_types_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.brand_types_id_seq', 95, true);
          public          postgres    false    242            �           0    0    brands_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.brands_id_seq', 24, true);
          public          postgres    false    240            �           0    0    coal_froms_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.coal_froms_id_seq', 9, true);
          public          postgres    false    324            �           0    0    coal_types_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.coal_types_id_seq', 2, true);
          public          postgres    false    238            �           0    0    companies_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.companies_id_seq', 5, true);
          public          postgres    false    234            �           0    0    database_statuses_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.database_statuses_id_seq', 1, false);
          public          postgres    false    230            �           0    0    departments_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.departments_id_seq', 19, true);
          public          postgres    false    220            �           0    0    employee_absens_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.employee_absens_id_seq', 41108, true);
          public          postgres    false    304            �           0    0    employee_companies_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.employee_companies_id_seq', 6, true);
          public          postgres    false    296            �           0    0    employee_hour_meter_days_id_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.employee_hour_meter_days_id_seq', 21, true);
          public          postgres    false    332            �           0    0    employee_payments_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.employee_payments_id_seq', 7, true);
          public          postgres    false    330            �           0    0    employee_roasters_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.employee_roasters_id_seq', 1, false);
          public          postgres    false    294            �           0    0    employee_salaries_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.employee_salaries_id_seq', 1079, true);
          public          postgres    false    292            �           0    0    employee_tonases_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.employee_tonases_id_seq', 175, true);
          public          postgres    false    326            �           0    0    employee_total_hm_months_id_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.employee_total_hm_months_id_seq', 74448, true);
          public          postgres    false    300            �           0    0    employees_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.employees_id_seq', 401, true);
          public          postgres    false    298            �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    212            �           0    0    galeries_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.galeries_id_seq', 52, true);
          public          postgres    false    310            �           0    0    group_vehicles_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.group_vehicles_id_seq', 29, true);
          public          postgres    false    244            �           0    0    hauling_setups_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.hauling_setups_id_seq', 1, false);
          public          postgres    false    290            �           0    0    haulings_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.haulings_id_seq', 1, false);
          public          postgres    false    288            �           0    0    hour_meter_prices_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.hour_meter_prices_id_seq', 11, true);
          public          postgres    false    334            �           0    0    hour_meters_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.hour_meters_id_seq', 18, true);
          public          postgres    false    282            �           0    0    locations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.locations_id_seq', 23, true);
          public          postgres    false    236            �           0    0    migrations_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.migrations_id_seq', 130, true);
          public          postgres    false    209            �           0    0    mines_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.mines_id_seq', 1, true);
          public          postgres    false    226            �           0    0    over_burden_flits_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.over_burden_flits_id_seq', 10, true);
          public          postgres    false    284            �           0    0    over_burden_lists_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.over_burden_lists_id_seq', 23, true);
          public          postgres    false    278            �           0    0    over_burden_notes_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.over_burden_notes_id_seq', 4, true);
          public          postgres    false    286            �           0    0    over_burden_operators_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.over_burden_operators_id_seq', 20, true);
          public          postgres    false    280            �           0    0    over_burdens_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.over_burdens_id_seq', 6, true);
          public          postgres    false    274            �           0    0    payment_groups_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.payment_groups_id_seq', 21, true);
          public          postgres    false    306            �           0    0    payments_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.payments_id_seq', 42, true);
          public          postgres    false    328            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    214            �           0    0    pits_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.pits_id_seq', 1, true);
          public          postgres    false    276            �           0    0    pohs_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.pohs_id_seq', 3, true);
          public          postgres    false    222            �           0    0    positions_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.positions_id_seq', 123, true);
          public          postgres    false    218            �           0    0    privileges_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.privileges_id_seq', 34, true);
          public          postgres    false    312            �           0    0    purchase_orders_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.purchase_orders_id_seq', 37, true);
          public          postgres    false    308            �           0    0    religions_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.religions_id_seq', 6, true);
          public          postgres    false    224            �           0    0    roasters_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.roasters_id_seq', 1, true);
          public          postgres    false    232            �           0    0    safety_employees_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.safety_employees_id_seq', 12, true);
          public          postgres    false    322            �           0    0    status_absens_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.status_absens_id_seq', 16, true);
          public          postgres    false    302            �           0    0    statuses_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.statuses_id_seq', 5, true);
          public          postgres    false    250            �           0    0    units_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.units_id_seq', 3, true);
          public          postgres    false    246            �           0    0    user_addresses_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.user_addresses_id_seq', 901, true);
          public          postgres    false    264            �           0    0    user_dependents_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.user_dependents_id_seq', 14, true);
          public          postgres    false    318            �           0    0    user_details_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.user_details_id_seq', 435, true);
          public          postgres    false    262            �           0    0    user_education_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.user_education_id_seq', 28, true);
          public          postgres    false    268            �           0    0    user_experiences_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.user_experiences_id_seq', 14, true);
          public          postgres    false    270            �           0    0    user_healths_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.user_healths_id_seq', 26, true);
          public          postgres    false    272            �           0    0    user_licenses_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.user_licenses_id_seq', 16, true);
          public          postgres    false    316            �           0    0    user_privileges_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.user_privileges_id_seq', 176, true);
          public          postgres    false    314            �           0    0    user_religions_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.user_religions_id_seq', 49, true);
          public          postgres    false    266            �           0    0    users_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.users_id_seq', 403, true);
          public          postgres    false    216            �           0    0     vehicle_breakdown_details_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.vehicle_breakdown_details_id_seq', 1, false);
          public          postgres    false    256            �           0    0    vehicle_hms_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.vehicle_hms_id_seq', 2, true);
          public          postgres    false    252            �           0    0    vehicle_problems_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.vehicle_problems_id_seq', 1, false);
          public          postgres    false    254            �           0    0    vehicle_statuses_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.vehicle_statuses_id_seq', 274, true);
          public          postgres    false    258            �           0    0    vehicle_tracks_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.vehicle_tracks_id_seq', 583, true);
          public          postgres    false    260            �           0    0    vehicles_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.vehicles_id_seq', 275, true);
          public          postgres    false    248            �           2606    16526 (   absensi_employees absensi_employees_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.absensi_employees
    ADD CONSTRAINT absensi_employees_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.absensi_employees DROP CONSTRAINT absensi_employees_pkey;
       public            postgres    false    229            O           2606    17300     atribut_sizes atribut_sizes_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.atribut_sizes
    ADD CONSTRAINT atribut_sizes_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.atribut_sizes DROP CONSTRAINT atribut_sizes_pkey;
       public            postgres    false    321                       2606    16590    brand_types brand_types_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.brand_types
    ADD CONSTRAINT brand_types_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.brand_types DROP CONSTRAINT brand_types_pkey;
       public            postgres    false    243            �           2606    16581    brands brands_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.brands DROP CONSTRAINT brands_pkey;
       public            postgres    false    241            S           2606    17328    coal_froms coal_froms_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.coal_froms
    ADD CONSTRAINT coal_froms_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.coal_froms DROP CONSTRAINT coal_froms_pkey;
       public            postgres    false    325            �           2606    16571    coal_types coal_types_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.coal_types
    ADD CONSTRAINT coal_types_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.coal_types DROP CONSTRAINT coal_types_pkey;
       public            postgres    false    239            �           2606    16553    companies companies_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.companies
    ADD CONSTRAINT companies_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.companies DROP CONSTRAINT companies_pkey;
       public            postgres    false    235            �           2606    16535 (   database_statuses database_statuses_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.database_statuses
    ADD CONSTRAINT database_statuses_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.database_statuses DROP CONSTRAINT database_statuses_pkey;
       public            postgres    false    231            �           2606    16463    departments departments_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.departments DROP CONSTRAINT departments_pkey;
       public            postgres    false    221            ?           2606    17111 $   employee_absens employee_absens_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.employee_absens
    ADD CONSTRAINT employee_absens_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.employee_absens DROP CONSTRAINT employee_absens_pkey;
       public            postgres    false    305            7           2606    16851 *   employee_companies employee_companies_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.employee_companies
    ADD CONSTRAINT employee_companies_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.employee_companies DROP CONSTRAINT employee_companies_pkey;
       public            postgres    false    297            [           2606    17428 6   employee_hour_meter_days employee_hour_meter_days_pkey 
   CONSTRAINT     t   ALTER TABLE ONLY public.employee_hour_meter_days
    ADD CONSTRAINT employee_hour_meter_days_pkey PRIMARY KEY (id);
 `   ALTER TABLE ONLY public.employee_hour_meter_days DROP CONSTRAINT employee_hour_meter_days_pkey;
       public            postgres    false    333            Y           2606    17418 (   employee_payments employee_payments_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.employee_payments
    ADD CONSTRAINT employee_payments_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.employee_payments DROP CONSTRAINT employee_payments_pkey;
       public            postgres    false    331            5           2606    16842 (   employee_roasters employee_roasters_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.employee_roasters
    ADD CONSTRAINT employee_roasters_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.employee_roasters DROP CONSTRAINT employee_roasters_pkey;
       public            postgres    false    295            3           2606    16833 (   employee_salaries employee_salaries_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.employee_salaries
    ADD CONSTRAINT employee_salaries_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.employee_salaries DROP CONSTRAINT employee_salaries_pkey;
       public            postgres    false    293            U           2606    17370 &   employee_tonases employee_tonases_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.employee_tonases
    ADD CONSTRAINT employee_tonases_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.employee_tonases DROP CONSTRAINT employee_tonases_pkey;
       public            postgres    false    327            ;           2606    17052 6   employee_total_hm_months employee_total_hm_months_pkey 
   CONSTRAINT     t   ALTER TABLE ONLY public.employee_total_hm_months
    ADD CONSTRAINT employee_total_hm_months_pkey PRIMARY KEY (id);
 `   ALTER TABLE ONLY public.employee_total_hm_months DROP CONSTRAINT employee_total_hm_months_pkey;
       public            postgres    false    301            9           2606    16860    employees employees_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.employees DROP CONSTRAINT employees_pkey;
       public            postgres    false    299            �           2606    16418    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    213            �           2606    16420 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    213            E           2606    17178    galeries galeries_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.galeries
    ADD CONSTRAINT galeries_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.galeries DROP CONSTRAINT galeries_pkey;
       public            postgres    false    311                       2606    16599 "   group_vehicles group_vehicles_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.group_vehicles
    ADD CONSTRAINT group_vehicles_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.group_vehicles DROP CONSTRAINT group_vehicles_pkey;
       public            postgres    false    245            1           2606    16824 "   hauling_setups hauling_setups_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.hauling_setups
    ADD CONSTRAINT hauling_setups_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.hauling_setups DROP CONSTRAINT hauling_setups_pkey;
       public            postgres    false    291            /           2606    16815    haulings haulings_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.haulings
    ADD CONSTRAINT haulings_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.haulings DROP CONSTRAINT haulings_pkey;
       public            postgres    false    289            ]           2606    17437 (   hour_meter_prices hour_meter_prices_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.hour_meter_prices
    ADD CONSTRAINT hour_meter_prices_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.hour_meter_prices DROP CONSTRAINT hour_meter_prices_pkey;
       public            postgres    false    335            )           2606    16788    hour_meters hour_meters_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.hour_meters
    ADD CONSTRAINT hour_meters_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.hour_meters DROP CONSTRAINT hour_meters_pkey;
       public            postgres    false    283            �           2606    16562    locations locations_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.locations
    ADD CONSTRAINT locations_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.locations DROP CONSTRAINT locations_pkey;
       public            postgres    false    237            �           2606    16402    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    210            �           2606    16508    mines mines_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.mines
    ADD CONSTRAINT mines_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.mines DROP CONSTRAINT mines_pkey;
       public            postgres    false    227            +           2606    16797 (   over_burden_flits over_burden_flits_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.over_burden_flits
    ADD CONSTRAINT over_burden_flits_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.over_burden_flits DROP CONSTRAINT over_burden_flits_pkey;
       public            postgres    false    285            %           2606    16770 (   over_burden_lists over_burden_lists_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.over_burden_lists
    ADD CONSTRAINT over_burden_lists_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.over_burden_lists DROP CONSTRAINT over_burden_lists_pkey;
       public            postgres    false    279            -           2606    16806 (   over_burden_notes over_burden_notes_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.over_burden_notes
    ADD CONSTRAINT over_burden_notes_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.over_burden_notes DROP CONSTRAINT over_burden_notes_pkey;
       public            postgres    false    287            '           2606    16779 0   over_burden_operators over_burden_operators_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.over_burden_operators
    ADD CONSTRAINT over_burden_operators_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.over_burden_operators DROP CONSTRAINT over_burden_operators_pkey;
       public            postgres    false    281            !           2606    16752    over_burdens over_burdens_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.over_burdens
    ADD CONSTRAINT over_burdens_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.over_burdens DROP CONSTRAINT over_burdens_pkey;
       public            postgres    false    275            A           2606    17125 "   payment_groups payment_groups_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.payment_groups
    ADD CONSTRAINT payment_groups_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.payment_groups DROP CONSTRAINT payment_groups_pkey;
       public            postgres    false    307            W           2606    17379    payments payments_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.payments DROP CONSTRAINT payments_pkey;
       public            postgres    false    329            �           2606    16429 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    215            �           2606    16432 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    215            #           2606    16761    pits pits_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.pits
    ADD CONSTRAINT pits_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.pits DROP CONSTRAINT pits_pkey;
       public            postgres    false    277            �           2606    16472    pohs pohs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.pohs
    ADD CONSTRAINT pohs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.pohs DROP CONSTRAINT pohs_pkey;
       public            postgres    false    223            �           2606    16454    positions positions_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.positions DROP CONSTRAINT positions_pkey;
       public            postgres    false    219            G           2606    17202    privileges privileges_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.privileges
    ADD CONSTRAINT privileges_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.privileges DROP CONSTRAINT privileges_pkey;
       public            postgres    false    313            C           2606    17169 $   purchase_orders purchase_orders_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.purchase_orders
    ADD CONSTRAINT purchase_orders_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.purchase_orders DROP CONSTRAINT purchase_orders_pkey;
       public            postgres    false    309            �           2606    16481    religions religions_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.religions
    ADD CONSTRAINT religions_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.religions DROP CONSTRAINT religions_pkey;
       public            postgres    false    225            �           2606    16544    roasters roasters_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.roasters
    ADD CONSTRAINT roasters_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.roasters DROP CONSTRAINT roasters_pkey;
       public            postgres    false    233            Q           2606    17309 &   safety_employees safety_employees_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.safety_employees
    ADD CONSTRAINT safety_employees_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.safety_employees DROP CONSTRAINT safety_employees_pkey;
       public            postgres    false    323            =           2606    17102     status_absens status_absens_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.status_absens
    ADD CONSTRAINT status_absens_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.status_absens DROP CONSTRAINT status_absens_pkey;
       public            postgres    false    303            	           2606    16626    statuses statuses_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.statuses
    ADD CONSTRAINT statuses_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.statuses DROP CONSTRAINT statuses_pkey;
       public            postgres    false    251                       2606    16608    units units_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.units
    ADD CONSTRAINT units_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.units DROP CONSTRAINT units_pkey;
       public            postgres    false    247                       2606    16689 "   user_addresses user_addresses_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.user_addresses
    ADD CONSTRAINT user_addresses_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.user_addresses DROP CONSTRAINT user_addresses_pkey;
       public            postgres    false    265            M           2606    17229 $   user_dependents user_dependents_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.user_dependents
    ADD CONSTRAINT user_dependents_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.user_dependents DROP CONSTRAINT user_dependents_pkey;
       public            postgres    false    319                       2606    16680    user_details user_details_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.user_details
    ADD CONSTRAINT user_details_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.user_details DROP CONSTRAINT user_details_pkey;
       public            postgres    false    263                       2606    16707 "   user_education user_education_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.user_education
    ADD CONSTRAINT user_education_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.user_education DROP CONSTRAINT user_education_pkey;
       public            postgres    false    269                       2606    16725 &   user_experiences user_experiences_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.user_experiences
    ADD CONSTRAINT user_experiences_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.user_experiences DROP CONSTRAINT user_experiences_pkey;
       public            postgres    false    271                       2606    16734    user_healths user_healths_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.user_healths
    ADD CONSTRAINT user_healths_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.user_healths DROP CONSTRAINT user_healths_pkey;
       public            postgres    false    273            K           2606    17220     user_licenses user_licenses_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.user_licenses
    ADD CONSTRAINT user_licenses_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.user_licenses DROP CONSTRAINT user_licenses_pkey;
       public            postgres    false    317            I           2606    17211 $   user_privileges user_privileges_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.user_privileges
    ADD CONSTRAINT user_privileges_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.user_privileges DROP CONSTRAINT user_privileges_pkey;
       public            postgres    false    315                       2606    16698 "   user_religions user_religions_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.user_religions
    ADD CONSTRAINT user_religions_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.user_religions DROP CONSTRAINT user_religions_pkey;
       public            postgres    false    267            �           2606    16445    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    217            �           2606    16443    users users_phone_number_unique 
   CONSTRAINT     b   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_phone_number_unique UNIQUE (phone_number);
 I   ALTER TABLE ONLY public.users DROP CONSTRAINT users_phone_number_unique;
       public            postgres    false    217            �           2606    16441    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    217                       2606    16653 8   vehicle_breakdown_details vehicle_breakdown_details_pkey 
   CONSTRAINT     v   ALTER TABLE ONLY public.vehicle_breakdown_details
    ADD CONSTRAINT vehicle_breakdown_details_pkey PRIMARY KEY (id);
 b   ALTER TABLE ONLY public.vehicle_breakdown_details DROP CONSTRAINT vehicle_breakdown_details_pkey;
       public            postgres    false    257                       2606    16635    vehicle_hms vehicle_hms_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.vehicle_hms
    ADD CONSTRAINT vehicle_hms_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.vehicle_hms DROP CONSTRAINT vehicle_hms_pkey;
       public            postgres    false    253                       2606    16644 &   vehicle_problems vehicle_problems_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.vehicle_problems
    ADD CONSTRAINT vehicle_problems_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.vehicle_problems DROP CONSTRAINT vehicle_problems_pkey;
       public            postgres    false    255                       2606    16662 &   vehicle_statuses vehicle_statuses_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.vehicle_statuses
    ADD CONSTRAINT vehicle_statuses_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.vehicle_statuses DROP CONSTRAINT vehicle_statuses_pkey;
       public            postgres    false    259                       2606    16671 "   vehicle_tracks vehicle_tracks_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.vehicle_tracks
    ADD CONSTRAINT vehicle_tracks_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.vehicle_tracks DROP CONSTRAINT vehicle_tracks_pkey;
       public            postgres    false    261                       2606    16617    vehicles vehicles_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.vehicles
    ADD CONSTRAINT vehicles_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.vehicles DROP CONSTRAINT vehicles_pkey;
       public            postgres    false    249            �           1259    16408    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            postgres    false    211            �           1259    16430 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    215    215            �      x������ � �      Y   �   x�mͱ
�0����a�I�4Y��
.�d�m2��oN��ù7l%�;�s=�0Rk��{LS#��!���mK��e� Q�D�"�FE�I��7�CN?������9\r�[X=�%Ŵ����<��O�N�jOf�           x���[s�����_�c��NA .�N�$��Nv��dw��3���%v�뷰Ax�g�t�N�Z2ҧ����"s�� �Z&�$�%��Q�DZx�Q����/�*�� mӬ�"F��,UUG�?裿g��|J��"ȶQ�f�2ԅ���J�nG����O9/i��"�P����y���^��F�(4�&���I�4Ca��A�3�cv�x�=����f��t�z2Z��\�n� ("�)ȑ4�%CZ�H�4W2�n1��wHS�2��O�p�Y�������l��c�U>6M��y���P� �t�t�jʼD�,�^�5M��OP���]G������	���ץK�O߂m�$��ʕΗ�xE���u��QL�ܵ~��V����3R�Yb�k?�֨�����p���I���k�"�1	Zn"ʏ*�Q ��i��	����s?j�c��>�<��1gBaL������$�"2a$[��sA4x�W3,��[I��;$w��H�^�|� @M��D�\����[l���Nꏛ+�k�4�ry�S��� ������O2���oj���1D�Y��U�8�1VQ\�V5�*.�״h>���q�c�U��$ED�p����2��
����f1��Czz%J�D���M�<�@���&�l �p�,7�T��̑\��я�9pC���H/�o4�?i��t�>4{o�9��C���\�0���n����PBXE��"��������-�:��~W�cF��&���f�C�6A�c�2�{��Z�!����Ft�I򠐊.ȣ���(�g2�O9�B�u��|�]M�T%`0�5L��m�ٺ�p7�O�.��N��0�����$MxR�'j�M�Y|�w	U$#@��	�c)��N@�7U��4Ѡ����σ�gB�)|��[��x��8C��E���eޙ�h��L����A!D��>s.`�M���� ӊ"�I�ت]Nɳ��2�������o� n� `�u�bJ�״Р���\r���r��p�[��w��p�]8�Ӵ��:ݸE^"_#DZ�C�d(��4/�@3�e�@>.��;��d"�P��$ȥ6$�L� ۴i�ZW	Gh]	�������gH�ws���a�2wlX>�;6*X�M�e�����z=� �=�s)� P���C�[	��8*�4	��;�3�6���W��N�c|6�`��a,�.o�e{B��0����=%� ��J��	 �M�y��h$o����k�tS�'5���&������A9$b'ۀ36�K�(����*�@!�j����i��SM�D��F�r	�&����ݦwW���"+�u���N�6�&��.}�k�,��²�a��+��o&��.|K�y�;�}?W���#��,���V>�����>>|���A#^���� �I_8�>#�����DyuL��/4e?��Z�+ںE���HL�ɳ��|�4]����S=Y�]��o���a�&tѧ$,l$&�*r����E�*��[� )o[*mo�&�G��`MgU�<h�Xn^,@Hg�,0�ݪX����0A92���}�E�L@<�/����2��?��9��_�/�K!�}⯴;)lUjR��iV��Mɣ�rqZ�F��_�AV��n+8:��h����*�� s�,�<������E�+��`����
8בQ�a�裦U�.�p4���� o��y9�c����Wـ<�,����T"PiTQQ5呣ҹ=t�G�i�8*��8�E�Qչ�b��!�wOwq���E�=|��r�*�a K4���)�v�E�!��Ꮵ �0 A�Y��HS���_�w�e3��r���6���%�j>�7ZPgR�4,�[6 ak��P�M�f�3����M�g��?>���J]�O�ć�$ٽ��3�w���-�ǪN�Ծ�O���{hU� �=.t���M.0��ۄ(̰�0p�R	�+Xx� �9@����ߦj��'4_1���E/�N����%�_|n:�a^�d�Ҧ4��U�����6�B��㻧Ƀ2��g�����˗ ��(�      	   R  x�M�]o�0���e�`ߗ�6JɄ]����ڌR����K[ҫ����yN�^�����I����z��z	/��'��|�A+x��{<9ury3�Vc�#2��3�肯=y��0|�y��:H�JϨ�/H/V���g	A��4��-��$���wM[i��t�a8�N�:����QK+�^�=,(��l��tM_5uc K�q��^@E�t�;i�\u�Z����JIs����^Bԥ�=���h������sD��e]�%m����"�d*���"&���ȸE�u�M�|�EG'ݞ4���
�F��\u{X�����E�N��!,#8��6�n]Ɖ      ]   �   x�u��
�0���S�2�vmg�;:6d�C����?��	!�����a�3*uF��@Vu&dg)��a�o ���>4N�!�����]'O��	}?��	��l��^m��d�W���5O����� ]�V�w�xS�1�`�U9L�B�`�Wri`�]c��Y���&��Ųn�����ʮ���=2�gB� �U�         9   x�3���t����L�PpN���/�L��".#N_OWN�̔��T�4�l� #��         z   x�3��u�q�FFF���Fؙ
fV��V�fX�b���8��9�J�R��RJ�ҁ�Ȉ˘3�K��7�3(31�$Q�+�2QAW$����&N�̒�D�Ģ̒|t�@���A������ ɛ4�      �      x������ � �      �   �  x�}R���0=��������U�Rq�x�JU�Sa��V(�YM��{of�:6J؅�"c���3�����t=���0;�L�h��3z����K�]S��Z�rW��!_?6��*9^�V�*xy�zFm�P�Zw9P���ܑ����!匉����y�5�E����kp��M��tp\����#)��T��@t��jLx�A�m��h�F���m��{��"�t=�}�l���`�!�Y/}<�aH����v y��I5o�(f!�8d
�V9x�:���u��>,����Z�%O�u�<)A+bN���g�5uVV�^�&Y�S�;Z9�O1G#��;z��xF�UL��5i�?q9���є�S����C�� ��5��]�0~$�-`      I      x��}ے䶱�s�+��V x�9�'��̙�h�v8BA�[��z�u����d��	���Q]�J^�X�\���~�O����TW��������ݛ�O�s�'��?�_���4צ����w��k���+Mwm�?����w��<�����Cv�U� 7��<\[����U~�޷�F���k�&���Gt(��k���צcd~��Gn�m��&d����T���-z͍��vA�-#���>r�*d[]�5#7�g�}��U��g��?lA~~ط`�������n���i����0���i�:\k�af߇؇��:yB>���g�g�}�e��w��e����t�ՂX����<6����I~�Fx{����o���<~Oꏣkyls��<���%u	������mó�ĕ`��Y{]��jS���~�L�`��|��V�L��v�ǦY�M�؂u%��ja�n]lh��0��K�����Wgc�k�n^#��@C	6�RX?�3+<IU�����V���z��x������ ^-j�<�z���ٟ�?��e`�e�庭���Cl�_���Y�n�-�y�_�����r��y�&��L��BW��N�r�����0aT����y]�y,8P��2��Z�g�ק^�V���5���ޠ|�cՂ����ɷ�X�k�[뮾=?����<~8�OGWw�.�%?�w���Ŏ�ϣ�끛w*_�8��*8֐GW�w+�w+��H��KUYttMp׍�㍿��Zx	]�)�GW7��_�h�e����.<�ͣñ����݂�d-|U�G�W�t�-��.��ˣ�k�t��mk����[oM+�~��[�o����y��Nx�6����&Ӹy�Np���CW�vac4N�K5�H肕�}�������h�mlDT�	^��y�j2�L�+?��I~|�|��'�g��sک�b�Q5�,{L�v�I��k�� �'���P+�;�!� �v��[u@��J"���hE�#&aV7§�4"���ͧ�<���Gl\��5��T#|Fz��V������������P�_���m�i�H����~�.�g�~�@,����|<G��;��=��FŎ2X�q�Fň2��Py�e$L�`��b�;���U����9��~�[�'Lk�M�l����C��u���߻V��՛n^�ގ?��'�1���y���h��{��˝.���Q���޳�XL|������[�[vp݁�H8¯t{83^�_���yOBx���{x0�U����už�~f��ų�N<Ga��km�ϵ��ڱ�x��֜C\2�<�;�v��g�����1Ĺ:�v�����˼������';�ٛ�ׂ��%�D8��������ݟޟ§�^�xoF'�vtŊ���6>�i,��ȗw�yt<��m���8���\�\���{��?[�H���5y�cG���	]x�6���5z?�wi���_]g��G�;�9�ލ�O�����>�q���_g.Ѯe$t+g\ς�w�1��k9Ӳ�8W�Ϸ�8��={'gVπ��E1���L�ș�E�g��^��9D��VΨ,*<�j�Z[�KE�^��,��|��.��('�+.�E�3��G'T��w]1�,:�ɱ>�㟷�y���q9��}�+`}e�#�+�E�}[�т.iP\-��+��'�|��в��i��"b��i���GeeX�
����6\	��i]d��>������GB>���o�����~/VD߼b]�w��z5���Z�JxΨ�(5�֙�HVZcV������5�q��U�ԯ;�:�����5��b=���g6���\�~�l��U�j$+m1+q��ϋo�����t�����<�ì�y��O\��,�V#Y'xn�Y��Gb���sc$�?0��xخ�t���؈Qđlx���TAWu����xs��Lnw$��*[�p>����+T+�Z��?�y�����d��:ckϋ��2z+d��V,z��3��`k�U���7n���J���֠�
�'��S#Y'�ؚs@k���mr$+�~[{(���P�6�lx�R�W��׳���2�"6c����|�����������8�_��G�z��[�	�f�=�wB�=�L��9��l;W��y9[	6(k8�,P�Ւ��R��,�o�@�J	]�	k!��N�#I-U)���땼�rq~'E>.��f� �s�~_tᏄ�j5
0�Z��\i9�V3W�5��{l=v�ǲVc(��o+�&�j�g���������%
l��	��>�e1,9/kU?���c!������U�||g��K\r�ֈ�CVb49l<��k.>o�!�Z�a�9�{��/��"�����j�qN�c��+�w�a��&����"���;��W3��U���^�ߝ�Ƨ������)�!m�z�\��_�H�ext5����*j�k�|��%�S��]��D��3�d��z�Z��2��r򩄑,R�]���jO(�^��Q��D���%w-J0I���*'.r��)�H�	^���b�:?#�h�.r�u����#!���r*
�FN���j$�T�oע�/�X��𭟊���Z��K���F�?�9b�8�4yms*��ka·f�X�oyGV��%����Z��)K��G�x$TToׂ��M[��&E�S?-�iToע���<��������,RQ�]�@+�M<�)vШݮE��]i���2�kTn��C�*�����ӗ7_^>�§=ƘF�|���3Zg:���[�l|u���ˢ�^��L����d��qY�Į �~��_F�֪�\-��<g�v�;+ji&.�EKd*h��VV�TY4�;8��w��>=Ͳ.��_fk���(�7�E�O��
Ԫt�QJc7����GBW{�,:����
�#��]v_��7q>3��)�u9&?��u��P����U:�:�E���KƆgU�^k�H�2�u�#vy�����ִ�{#+x�<:��;�{���z>��;y_����I��S��?ݝ����w�����/��ꋣ�;U�9�S��3BT�L�;`�*�8U��G�: l�@��ˊ*=��z�� �{3��R�UQ�&�/϶��
�m���U��w]r$�T�5`�	��o���:m�z܄g�*��`�g�����"�E���m��Z��l�م]`�*��0�8?+?I�$�O�K�� �ۄ�JC{Q�#٠�6��;�/�}��M2��F�e�ʤZ�j�mPg��_�?���P�h��?����;�^e�@?\�:��#Ƥ%2�]U][p�뙧	]Ը�#��� `�+߹��Nq�����lS�	�`l<G3]�N��X�?��Q�?�cP������L�HM|�/??|xy�u�~8�?OD�C��K���'���"2 �&~W���}�!�yD���
��=�0�D����
0J�fx~���%X��Q~_�3%X؜�{��z7����X����n�G��T��lpMi��\�=�j�a�QAdJ�!��C���T��,lm��+)9>g*�W� 3�G.}}�5�&ǔ���/7�T��7w7_�z�p�G���X�7FφRM��X�F�k��(����E����<S]-2Xp�����R=,2Xp�хzk�%�:f5p�n�=4�%�J���UK�wCTb�ݐ�X�����F��ߨ2X��
K��r~�X��e]5E#� �u9��+j��渐&�O��ŢL�.�?���CP�w�3��-9r�3P��}��d09����+R��d09b�o2��Gy�DΏ���㺖������:��B�w���2���q.����������c��?_*�����ݛ72�ƪ�;��<�~�e�jW�2Vu$ܱ��}�uĆ� �L��<'*ǭ���U����:X��-��/�O���x>ؖG�/�"�=|����[�_+5�>�_*��i�	]��L'��n$o�u*�����q����Qʑ{p��:�m行������&���~[Wd������lų�������eԧ$�;h�C)Iv����	�+-�>�/m�߃�*��J-����˨�����u�VJ��v|~y�v��y    �?�ςI@��Y?�Be�qujX�<�4*;�x�(���o�Sj��/7�����W�D��
,[�v���P?b�4��z�,�#��,�$%�Z�&���iI,8{�o�TG�<ө�t��;��0��E]�;��f0�H��W
�SY�Pe�&�r�z��/~#Q#����@�D}�8�>��N����M��)�g�aTv˨A�:f0�ɾ�Q}3����4��.֓�x�%0\��7�� �B�ڗ��ZDƄ������u�w�R�?��_Σg'��+VSR��mU�~\S���u�e��A�s憟�<9��G����EB�E����#�qL�O�M��n^k�M�K�2�����rƭ���"�R�b0�;�O�]dp�u�T�����%����#T�Ӽ� ^�>L{�ۧ痓����[*�M��K������!4������~�u>�*|:�+k���yd�`~S�=+���h�{�J6C�h�zޗT�l�V�g���HcVwR�˳h��Q�cDhJ9�E;X+�pU.ŀ�p�J+�E�9���U�Y4�k�Λ=��w��pE7͈��J�,�c�pm�>h�v�����U�Y4<NKw��w��΢���gb�J�+�ϻ�>��w'��-���u~,��+3�I��|J	�YY��#!
?b��������_N����X�a��ʪ��j�i�͢��>}"�f��E�b
sܢ������eѰ�`�g�sګZ+3�=R[yM�3�g����ft�oʢc+�t�Kt���y�3��Ce�A����s�YtV/�kW��,:�2�k��l�"7Z�E�W���(^CW�A��r����;lҸ���+���KO"?.J1��R��e��?��z4+5�y߆���4,��V���M�İ:{mF�*���,���>���NQ�����:0�:��j�;	]p���CU�o���5΄U��3�����>��@�/�^)F��;�Ίk�9�a7���{�w��$���f�I�V����z;���|�20�"[���ݠY��(����=�f��(����g\�����ův��؆�]k8�d�bT;xǴ�}Qj��R<#�)ִ�w�����X�x��nW�S1�<�a����S\h��B��b?;xx����V�<ؿp�g<�pv�p�Cq"fTVq�<ܿ��*�)����Һ���x��\V��x�����֪�u�����Q������ݛ���'�����
�wY6�ݾ��3�Xӣ��{Hp����{��_�"�3g�
Q��v�[,]Z�_p&�
�i�C�s��4�B7<g���_t�����q�C�{����b�W��x�bU�f�
��#�y�:ΘX����9x���N��Rw��s�2u�U����=x�:��h^
����Axob�O!α���0�N�Cz\����/�Y#Թf��7��5F�좾��^�ux�*���|.���bMA;3P�Ā���������_�K�N�K޽ܝ�_�O�S��_U	$��65cU�Zs,�"�S�@�Q������YG�yɢ����%YCi�Zx��欀wK���YU��{��3Yt���[z�,#�)�E�"�s�����L�8T�~��[�k�t�m��Yq@RG��z�+��Eu����K�,:�����>�Z�ޚVq��5����Bj���H�(����T�s���@Ժ�U\-��:�#�O��(�����pW�x=X[��\�
8�����ˢ�.�X-�Qq�,*�+��f#�v������׿��z���ʣH�t���s6�J�J���a�3��zI+{�79���=�R#��^���Ȟ�6΁n�m[_�����O�7��ۛ���� ��P&�ٌP]�]6�Xxw&�$�o��Z��3�Xǻ��.�zv����/�ۗۻ9y�������]����c�]M��lC!�$tQw�b[઄���vQ��b�#u�T+Mت{�}�^��L��#�+m�:� 6���,�6�W�D lxQ�]D�dF�� Rnˁn"ጝ%F2�H�g[�����9�l~�Qx�6�b�N����&؂wr�ߓ���Ug�|ouCZihm��� ���`�Cw!�@{�i�g8ԭ8(�"eQ��� ������{P�? l؟Z���Z;�� 6�e���=T�̻���<��]G���N߾�G�R�>�ǧ_���3�o�_��V_�|��Ѫ{���u�؀�Ǹ���+����.����H� s8�oUe`�o)'�q�Au���8��r�8h�Xn�����m�Ԯ+��m��h��ؚ7�c��縣U]i�X�}�'�Q�8�QW�'�ۂ�`��"l�˱����Nq���<�3���[y�pݚ��ې�i����G�A�r{ش�-�J�r̄��<�15�+�L��u�������?�������ۓ���(�H������ڨ�+����!�6�'�Vub�."<{���B-��n�+��C<G�Ϛ}�C� ��Q�����͋���>�6*ﺋ�`�	D[MEmTnu)��e���C�}�Q��]Dp~g/�.�Q9�]Dxrޜ�Uy�]ĄN6��
O*��3=�����,|:�Ѩe��B	�og��H,�#۵�Q^��`OV{u��kA�.������k�jه�ɣ�O��O��6�{1�����T��,Zb�Y���𶨾�Y��N%�P�*�-��d-�7�r3�'�k�C2��{h��]��Zu�̢�>�����Z��̢�>���["�w�}�����8-FB{���9����'���Ww޷���)���
L�V}(�h8C��!���e�-��M�g�`�BY �aԵ�F�EØ����N퇾~y���x������I�q�?l�{j�Ns��<���f�竝:ݭ��n)k��z����������W
�>c5D�d��e?|o�'?g���b�-;]�)��6b�;�N�>�+��_�T:��yIc�yṨhs��W�'NE�8���L.{�FE�8�O��FGE�8��	�'�����93�b�ש�	���3u(	8*�����j��x>*������z֍��&~ߗ�:����FEbx�?Pף����#���2��"�	�c���ʎ'ppn���[�	O����USu�O��~���ǹ�]_��6�gUVj�Zv���H��^���V���K#a�t�eD��V�z�B�g(U.��I�*�H𞆻W<���D�s!��Sd�	��?��I(u�O�H ��ng���!jѩ� I$�-糍�5�~ I��"���ica� �R��������o����_��S��q�֥N�_��9���ƫ�]��-�}
��W�N�ň`�U�Aʧ#&���Ut�g��wXEJ���5|��ޭW>��Aܩ�Yc�"���	�F:��A�n����f��k}|Ef����|��\����XbO!�����JL���J�r��ŕ&�]����1F�����{���5�<����7�;��|;�|��8	�W�R�~{�ڠt�l
	�����Rܤ�թk�T��ip5�,�2��C	�ϵ"�>�8�����o����S�t�5Q�Ed^V��Z�ymgP��|"�=�ʰ,:�����,���m��5��ˢ�y���O=w�y�<:���Ҏ��N*x�<:�Y���wR����av��2ظ�ܯ�kb7��\���\���\�Ŀ�8l���l|GW�'��U��>+�bV�S����� ���1�ft����:��R�T�'5�y��Vg<���T�=��ȷ�A��]D��U�*��`ly��	V��+t�6yz v�{�:g-�{�ʳ�*��������쫪:'����7��y���xp��qv'��C��t�7;����B:�Њ;M:��|r	�Ǭ|adTߑ$�A�U�Y�Q�$<�I���rbI�㺡՜�*;�D<�4!�K"�z!��Ve��x������ܟ�Ɠ�,vS`���U��7h��."�]�wOkw����q�5���i�������3�����"��f�m;��5Woo��O��/㛓�(��^^��4���T�=|��r\��n#�����z�ΟF�|O%q6���i�;��;l\:    {s�rs�gw��+Nkߥ�N���d�v�X]4I��n܋��~��>�����*s�dW�~d������W�:��{�����_?n��R�\��,���~�]xy���=��r3�UXv^�?Չw�{�����j������g���c��Dwξ�>w�ߚ�NE�w�q?�������;��������=?x�egٶ�(����_wy�g҅�/��{~e���N���U]�>�7y�����~<ߟ⿏2�n>����������q> �ӻۛ�N�o��=��7�w��dN�=���
rmÊ}:�� kp_qҵs��5�B������"[��de�kC����d��+�t��Z��"d�5k�����v��b��50����gy��FqI�أV~G��d�l�,!k`�i�'��a�♈58�4~�g?�T�F�N������L�#Y�8(d���2�'��(d��Z�gu؟��T�x)d9���Z�R!k`_l���j���J(�\��u��������7�Sy�V1a�ao���aՋV�V�b���[������͵�%C���͚��p�0G�5W��_��u|>��_�%��P'���]f���ڊ*�9�
�k�2+`G��f6��෮̪W�W�3N���%V�Y�O�z��E��\Rb^۩����}��K��FJ�����O�F��*��H�c�S��"����ϱӹ��hש�p�50���P�
��h�����?%��L��{�f}�Y���EV��=��i���Y�2�E��>8:���k���vꌌ"�`������bU�[�4�"�`��zr�NڮW�mY����V�z�d�:������'�'$�u>w�:e��*�zoHc����2ߌs���5N���H�w��h<��"h�5�	����z{������I~>�BCw"v��c�[�!�zGu�U�v]/U������Fj;d͇�G�j)�&t�s�ꄱ��U��'o0Ҡza�"�3��uܭ��+�."�'2<�A���C�k��%rU���!���@�a��Q���Yp@�Kqq��>d���!b�i9�Aב�!�����z�0t�"^iJ=�#���l�׊�6������c<߿ܜ�O�� ���4�������x7c|�ݴ~s��~�z��L�q���H��~�Ŗ��MJ�/�e$KT��bK��K��H@����BN�X�%xd�Y߼'�/r�%�v��ִ��<�%�9���:~��Lo�#Y"UWn	�Ih�{B:O:}�㚍�嘸A�%�Wl�=�ș����rK`}|\eA;41�EV��:z�#��a��Ⱥ�r_���ڵ�^C$��Fր��Z�QlA�d��,Pl�c��a�]�0kD��)��xMT��0��ب�Ŗ�>6~S��Jk��d�Ex���-Sg8}��rj�b�Ŗᝠ7-�}�\�d�b�Ŗ�ժ��B�h���U#j_����O�7_~y<���`w�L�/�%�G�����-�/U]��35��o���]	��s\�e�LS���N��~ZVɴ%��*�g��s[��t%�x�Q�*9Ԉ<w	����k�z��9�0K�(z�:�c�A��	<٪39
0�Jo��7�'�S9
0��#�f����c<!���_�L��ἅ��᝺�_�0���);���]�ۘ��~�%~���Q�
�U�������-%���sCi��_�o���8�=��X+��/�Z)�36��^���\X��S5�-Jǝ�WmK��L�j�68���� �G�c�2��fg������r�>�F]�A#٢��[>$mK�=���H�(]vƖ�Iۢ5z=�|^H�
;��荖y&>c��=�-��������C��k�S]�36$���s��
����Nu��� ��;dՉz���W=2���@*_�-tޞ��5!c<R����Z�4��BƦ�Z\0?�q;"q�Fud�ؖX���n4����?<�?�h+��N�'$��K"��=t�	�?y�A�DJ�RH-krV�45�,�FLt�H_[�<GV��4B���_S�������G�F
�Y�ѥ�;�`��ٻiT�����|<?=�Nџ{;�̛�qhd��-��Y�C� ���y!.�*�ɪ�`:��k^���"��96�����&f��{#+!�R|pť�������S�����Υ5ӪY�{rb�&�g዆R\pu�Q�e$\]�}|�2�����6��lk�Ye�s��5�:ʞ�ND���q�zk�
��t�=��
���q�\�R+�#�����a�5��m�A)�t:��}F��X�8a.��6�ZhdUC��Nh����z��t�=������my'N>����q����^��0�0Q�����DI��kB�^�Ob��sݿ"��NG�Ә0�qT;D\c�t4>��W3ջ�]��b3ؠ��"M8K ��z�U=m�C���M�#��Gy��~�il܇0��
�I�\�n?���\;���P㗗�ۧ�i�q�r�6�6
x�;���Q�Fd;{���|3�.�u���UMx7T�}������q��W��Lx?C�RM��T4}�&\EU�#a���&����c��dP��Lx��|=����V<���o`�Q����x$L���H��34��� g�4�D�a�"�?��SK#a�~#kL���TY��-u�#a��"����|�.􀈻u4������!�ћ�TG�8V{n��������y�����>Z�����U�}�����36�~'VGRM���R<f�;��;�*	S���������v���xd[�����0S���� l��Y��� �V�3�_�wo?�����O\�����v_èvíF�W��|���Y��j���Ã�o�)�CR�>���ܜU+�Ю���/�-����;�ױ9�cV�H�'[yvA��ƹl�<o��P���9,q:�X��49,��zuW��B%>��Kc������}���XǸ�Gm�:�.��[pU�T'nf0A��.�o#N�h�:k3�u��JN�Zu�f�+���gBO^녢��������k�顭Pr��?9�Q	Cp��9ꊓ�pT!O39?�pU�'�orU�M��;�o~�J������+16�Rɝ�78*��Z)}�}x�v��80}8x]�:j���`�܈{㴵������o���}s�G�xԓm�������/����$?�&H�t�����y|w�G��Ȭ��x$l�Rld~���[��V�'���3��*�ڪΘ9l<��3S���2�m�N��`�2Ӻq�J[�353ذ�6��9���豝:Q3��3�z�U�u�<���3���t�S�^f��g��)B�R���*��2˨K��?s��&�.�O���7�R��ghv��ny���?��
�!,u�e�X�w���G�TgYf0A��y%��݊呰�I�l8���u���mԹ�,X�iI��ϱQ�Tf��ȕ�+�TU���Ψ�`�>��J��뼿?����O'��<g�6f�����v����6z���I�&�y7���Z�v�� ������t��F��x����}Ի�<���㴪��_�ǧ�??�zg�?���MX�y�ܪS��ں_a���L\iMg7�z+��/�<���ܶ�?T&��!��sR(�'�^��GyI5��؛u%����2��:Uw�L�p�9<O�ǩ ��k[աi��r�__�z1`����W�y��T�	���{�NE�
0a�C���"T˦���U�		��S��
0��樲�z������ f^ �������U�
0a�S�"!����f&�Q�@�����t�/�&#�m+���*p��w��:`)5���6~}玽<�z��Zc���]��V�c��R<�1�^����ml�Z>֤F�R=�?����S?�ߞ�����瘚��]�y,~��պ�w�o�&l�� �X���SKuqS�	�}*���|����Sq�@���L\_���Ań0�U�uNA<�-*F�o��X�V�x;�Xq6�v��eY�4�q�jYA�J�q��8�O�ꤐT�� ���8V<�Xq汊 #T�� �x���T�� \o��    �t�R.gɍw�/�����z�
g��eW)�`����8V���u:��z���k�*�,B?k���w�R��+q�+�^�;���-C�U?��s�����Ȋc��^����UJ�Xd�O^�0��UJ�Xd�|V��+wg�f�Ċ� Ǽ�B���xu֙#[�v�EV��":G�#Y�KEV�,#�?X�:���EV�}��,.�+�w�z�3*/Wd���g88���HV��]�����f`�������YGӜ��u=g�u��3*�Wd��sޫuĨ�_���~wVe�L07��s6:U��e�a{\2��XA��&���fѩ�|���
&p`5G�:ٵۥ~�<���Ϊ�_���yuxOT�/�s8�W����{	<���KVe�8�,_������[��K��*�F���X���m��Y��>��gz\V;kC��U�/a�{�����L�dv���%�@�1��ff�>����;�w�ׁ�uR��'x��	��2�*��������:�ǀ�2y	<,*R��|';m��ʁ�!�i�!&Q��]�/�O��j��K��<!�ߪ7�Ǘ��x?�v�$f1��۰1�Ss��5����;�2�vM{��Q�N�\|�(��U	<xF>8���u����Y�u9�"NŢxǔBq���O	<\��XB==q����ՎOw\���RW�Zw�%�����{����9-J��(��X��5*>���s#>pu���%�pu�i	O�|x�����r�3��PP���9PY��¼hT�&��)�9��R��/������)|��u	W!�oW��)`�]P�dY4\�f��ˢ�
�f���Q�bY��]D�9j]�jòh�O�zx�[U�E�;
��Wؽ�*ןE��s{���ʢ���&Wgw���gQ��V�㩤�#��L~�Eڸ�X';>�}
�m�2"�Ve��hx�ׅ}Y�ZϮUy�,*�c<Wi�|l»�2�YT���E뙧���u*��E�{��Z�p�!��� ˢ����
U	]Հe�A��z�ъL�y6Wo�O�/woǗ��ߝ�G�����h����F�+m�5WK,lQ��X/�t{�kWi�W�r�Ǩ�EF�=����,#]��nu�5��U��m��?k��q�_�H�(��%�r����O�����;�������Դ�S��,�)-JbQq�l��
gzt�����kW�
{�3A�ԫ}���~d�s�g�S����.>�OM�z��.�u���[�ÎN+�l�g���Ԩ�J,��,�#�bz�G/��Y��j�י:�}S���@6i�"1j���{��/�s�w�Ro،���S#�LR�Ki�Ǡ֔����AF[-�"5���Z�c���<�9)eI������q�hL�S�sXr���y�JwR`#�����^�#٢�'�������Ⱦ~PY�oo��>�}�ç�V4�V���s7�������"~�����"�b�n�ߌ�>/�X�'��@c+�^�O��s�KLŅ�V^M��ɢ��_�2T��ɢ�9���D�ETm�X���π��s�p�R���Š�h���*�ߠ�q�x�R��}�Xm�7��2��YT�����M�]ǝ��J1�,:|��Jq�,�����b�Y4�����-kv��i_)����b���fZmt5�+�ܲV�JC�у���ʢþ�Ό_u��+Ŏ�����j?�u�eQ�t��(F�nߏ7��?�'/@�eо���&���aEWǈJY�D�����<D/���4�@��#)�m	� ��D��Qz�$">�}��d�kT��$"�㤽�x'��6����0�7D�n�HxwK��{Jo�BJ1�n��WA���*em1�C҈�	�8Mo��6���!i$RZ���*5m)�;�H����Aً=�;R�"����Ӈ�H���A�E�͈�J�Ug�%39�X���SĤgrj}μ>�M���칞�ѩ�9�HQ��.�S�����|~O4���o=�Yz��N"��N��>;�P�Oks	�_��L�Z��D����4�^(�9��X�3H0�$�F�F�g�*���$�$8�E$����Z��Dg�FT��=և4Rbm�x)�Æ����M!�k3��V'�&�@�Aut���:�7����'ծ_j��>#��ϼ|ׄ�ޤ}�ǧ��]�P����H��3o�j�.���}Ɓ�?��	I��J"�>C��	I����@W��ݸ�[���j/����\��q��?��;�'��+�{Q�Ь����-��Ќ bNu�+��t~�e�q�˟���6c[9f���W`�1^Q��}M�3�~�7��p�qh�1��+���g��u0}���-�g%5����4��l���̅>s�F�A���p��$���z�_�9��y�}��.��ˉ�b��.�<�{�L��00%~� B��[u�p�MǸ��Lw�	��`Q{���v����j�<�U�؀3/:�呰չ��8��)�e�wC����_Ɠ��8'3>�.tD�-��-���W���^v|�K�aF��Ox�E}�Ĺ
0��������r�8W�����9wZ���	��i%L��L8B�}���s}	6��}"wJ�e]�P�	�z��6���#|U��s&�%Ԅ{+�xK0�=$a�{+�Y��³3�����
>V��<�l[u�녾ޔ�)<sC1Q���K}|�_�9P���k�Ի��'����})z�c/�Ox�5��\�.��/�$��>��l���O�٥�'uG�7�?�4������$���}��x�&��:<e�d���8����K}12�E�^Մ��z�#�>$t5��V�ꋑAO☹����#�~��؁�Ӻk}12�s��!~���/G��K�#�U�{(G��&Ao%��W��(�	�$�)e��r_���!LD��/�a(r���,xW�C�P�a!")�֗�0�9�\Dv�/�a"B�c�Z�r�r���ȓ�Jp����N�T���������P
�����t{s~���\�`u�� �"���ܮ�3�$�N5�,^�g��H�Q���c�r{��'�s��
�n� ��%�2�H������w�Q�s��1���u�<�:"�=G�9�5Ⱦ�.m�||�{%���,P]���~L��%w�C�:%�\ܿ�u�q����nFI���L�F�|0��Q	���g!$k��%-�3w�Ϧ�q�-�#Y"|`���E��Fq0�RW	{��jLEy�:"%-�}�k�׮�"%A�?q���������:$%�q�&�;���5b$KTפ�%��3���UǤ$"����h�WmC���[`Uפ�������HH�ǽ��|�x{7�y�<�{�6�σ�lt���-���˗�忎s����a���na����:%���-�PԚ��d�z���g��]�,:��Il`���U���w=|~){L�y�0���#�c�sf��2��!u���i��3��=�N��a�g�l�h���ּ�c+��}��4�5��L�ƽ�dk���u��������@�.ˮ�[��@FȬ�Cp��y@�Ү0Kؚ�����c��T�o�{<�@�%�Y�_����
��)��w��������$?��K�M���f�b��~���*�����i<]��7x���;]���3�M���|[c��4�C׼�1��8�l?U�\�����`��k�8��������r��a>��NU�e����!^SUۖ��US+.֨���V�f6��-����(7�G�����"uPx^��-��שv�{���2X��:���R����6��k�TiW,<�����Fնe�p�A>�cE��j�`�~#�>���-��>"`�J��7�
Kոe��=֔R%�����<����s�`�~��r�R�n,�o�=d֪Z�����i��fs����D�O'� �~#�w��-��g��]ף��2Xp��O�`�NU�e���{�;�/{&q��Щj��a~��V'g��y��a�B�`��|�Π��,<��NN�J}���cCn�9�Vg�p�1�n�S-�:�`�1":�2��Jm��»��]��.�`�@�y�*�`�|�2"���8��W���� �  ����w�$�Rg0z8���W��#s�����ߞ���5҈�C����=�z�9��#��ͣ���T���oU�j/�`�T���S�����D���b�4(�F�W2�'�C�su�-m��2���\�=j\���`�t�wញ}Hn��WlzRa���hr#x�����l�d�Խ�/�>Q�gss�#4�٫\F�/��ˎƳ���q�~����'��X+P}���쒣W�
�쥮c�&��ȅ�k���K�q�u֙0�~ŕ`��B���k��_N�bӔ`�]B.��SH���#���-��מp�J����v`�T���Rm`�D#���k`�[�wN�J�U�	�C��R���>��:�!��*��'��Ձj7Le�:� ���|�U�p�V'�`�q=�兓ڿ��L6�s�
l��}�}��<�S�������Yy/�:�R�(A��:O�\�:��jy�6����PA�Pm@Ug���{���a����rS�
z��-G�&T��j�PV%�b�z�K5a*�1����JhH/����c��Z�+B����Vv�Y�3+A=��YG1��=Z*��V��\ծ��e���X��+Bų���mR;�"T<w1,�f�(��)�Mx��*��B�j�|�e�M6�M�?���l�_+��LB�\M��:�=��?V:�	]p�2_�3��k�x�x�Ǔ^�]L�*�zO���K��v�R�'p^���p��=�s,c9G'x��>���,儣T�	\���R�'ppU�g�J����)��=pJ�������x�sJ�����焣��	�/賐:���A*eS��3p��b����R>�w�+ģ�N������&kpJI��;�ՙQ�!�p��>�{La�J�P10����6�C�+H���/Q�ADK�R�'p���K���F)����9�_�;'��x��Qi��T��=<,�T���#��(Z��:�s�`M�
��ԙ�;x�����ԩ�;x�+���	���ὺ�n�S'{�����P�V�����6�z��U�|�qV�	eÄ�����;^��ԉ�;x	��o~篏p�ٛ��>�C��r���ݽ��Z�3xu<���wo����4����&x��|O�����k�MB�k��{J����Cuo��������������)�so=J�	�愧����g�/�q!.���{��Q�#.�Mdv3��O������_�����b�#�o�8���w��	���J�	GU&p����0L���ڭ�z��8��;�ޅN5��*8	~��o���b����mܦ�gZ���w������i��nܔ�_�v�u��̿0l~�U��v��L?!R��;���W���f�A��<��;��JLY��ZD2�;��� �]M�G�y��o������\���N�:����Vw��߱]s'����Ϫ���݈��9����Yu,r�������_�]J��nT�[;z���{;Y���Ͽ�=|�����5?��6WM�cs5w���n���~�������q����S���g����7�un��$���W�$�y�s
Ƭp�N�/z1NSy��z�o�����U�?"R�;�Ý���Q�"Os�USY|���?�n����,�~�N�Ɩ��G�S�������n~�t�?zɑ���m6���A�J���{0��w�G����3�f�g�j�;���zX�����,X����?�ԋ5-u�������a5�������������9z�m����,{�E�P~����r�$�֬��E�E~�Vf��U?�7���Z��w�g%#�/]l�E�t�ԛ���N�����������������uZ#H�&�?X/|�����O��hoA=�����yOK���k5�?��5׮�v�)�ѷܕl�#������秗�7���O� ��o�n�� qzuu]�"Pb�S���_��w��_��      A   �   x�m���0�bn@�.I9���Q���#2`8VB@�RC,��y���#,��P�DU����i��`����K��I�;�6��1�Y&~�$�%V��%��Y&��&0Hdp��ܿk7�c;���,��""��MP      e   �  x�ŗ�r�0E��W����eg�k��6;����m����r��2B�i�5^\�q� �v?����B.���q������?�`o?}�l��l9C�"0 �s�ry��$�Ot�Ѝ:�݊�����up����5��90�����n���a�x�4�Z0�4l,�Y�ّetl!����ڔ��䂏�O�f��܈-�������2x
����Q�d�W��x�F�/���GM3�|��|�c�0���$<��5ͤ
޽*�1^S�N����2�f�2��˼6~�]�ZN���9��.� ~��"��₊����ԇ�i&?��1P��)�8Oփ[�h��ô�?f�jl��	:�UX�䞸G�4#�t"�1�@K㇀"!��GE,�4��Ԕ�t=����&�hR�k�ĉ�u�Wy���RC�4�i������5p�Q�Ԋ��S�4�\�p�&�eo{�֦89wYӌT��\37��R�}���h\�4#�p�h� _����$t�z�N�Ɗ����h�~��f�;��V�f�}9�`�h�Ya�*y��4���h��2W��f/#^~ٽ�zIgАBS*��7{����d�q�H<�hF'6��H�ͦ ��.5�g�8y�/��,�J�+�bdbBiѫ8c*�2��T�Q�aŔ�9m��d[K��5�;��5�B/�h�d�\��v~uBG8�mLa��_�TK��(4�ܭ�1U�IZ      c   �   x����j�0���S���%�{,�-��\R0�4��%o_5PC�Uhs�F��A�����t�{�>n��	���I��^��pڟ�M�7dZ\��8`^n��v��3�&�6oK�� q�bcZ~�Y���II,��rJO��	K���R�G\�EQ1hK�E���h���i<���p��^�b�ij���
�V�(���|(�
�Xǒ�4܉��U�Y����7��d`��mu�E[ߚO���݃����<      ?      x������ � �      =      x���K�%�E�ի���o��P��-<�����1y/�	�і��!��cd�̜�ǿ����]���w��>�������op!|z����oǿ?rJ'���J~�1�R� ;/¡���~]d
�燭g�����ֳ'V[�nS9��(z�V��_��_��ZX�ϰ�ǜ��hA�'��~��)(�{��0an��#]���^e��y�7fo�ފ)+{�<7�K�勰��D�� ��3<l}3�9`��V\��O[Ϟ����68ejma��NY���)[��'X{�z�O�_[Ϟ���68�2,���/8t����]���[��+=l}/a�����e�py�z��^�[�����A^�m=[&Vx�zv�X�a��ub�>z��W[a�`�J�+o~CC�~b��a���2�=l}�����?��r	�ՉUMS9��68ejv��o��9�,}
N����֩Q��(�1�N�Z�߲�ި?����+cP��؆�y���V���������K[_�8��a��s9��ֳ�Ě}�rT[L
���I/��U���IQ�0*ec=m=�1����ֲ�������ֳgVx�z�̊[����J�1}ls��@#_!4�~"!5��~"#5��~B���Ȯf�G��խ�3��%���_(�l�+�"H��9��eqOZ]꾊�3���K�МOZ��{��{m������#}!��z�(�d�zfk=3���)�a�gB�d�zfk=����F$���3=pX�G�ZτؑLZτة���I�}a#*'����l�����T��ƫ|u����.À�z�ƾ�6;a�T.�#1��pk��E64<*RbCã"e64<*����Q�
����Q�)86�ѱ����?��/[Ó�RwE�
��PwE�@��W���%+���JX�5�&0�2���"5�"kX"	}� XY�1$"6�k��T�з]56r�&�{ĝ��o�GCJ4���L$�Fy�2Y+m&R`#嚄��疰D�l$/�>�q�:��=�]�h�WK�)�Y���+��À��a(-\��h�1��d�oq2�T��ɨϐ(k��yy2=l}��;L5�Z��AnO[��m���W�ᩛK�X�A�7��}��~��gc��5��J~����q�ēN���o���� ������V{ =�M��e�2��+�X*�{y�{�q��顱t����7�h�{Ͼ�p�����~���G����.ܱ=�?ܥ_M��F��[N$���@�Q!���.����� �������ן�S!*�'m�&�ֆ���x�&a�	��+>�ͼK� -yU�ԷwR�T����u���إ-�A򮐦>���o�}=l�yֆ�G�gm���OW^8��)�j���Ч�V'D�����D�҆��B�*����� ��vj���6J��-�6H����>������3��%��Ӌ�G`�1�c�4�r��O��%�����5�g'�g�.��31�=C�wryf4�����a�K�������9�vO�U-ƶ;8��ٝ��zm�n�9�w>|{�J����/����.wi��"����=�<R�鋝�罗����)����U��ԩ���y6�v6}��������\u9t}����n�8i�7`��2i;���Ά��x�f��h»���}Pd�ݛѧ֧������^�<7�o��w˛�[���<j�V�z�@g�H�i9��3k��6�y�-=�R:�����GG��I���HS�+ ��\i}I�/Ɂ��	�#9��3!�J"�g�2I&�gB"�i=�$�H��	���a��^�>���#i�WB%�g��FGZό��FH��#ʏ��}�l�ze�c���(�{��H������c�l=�o�����>�?ls�q����q�
i53���{�K���%AzXi��YIHʤǼ�\RV%��]��cB�'��T���4���*�g��վsu���H�����t�:�
 C�,e#�g��f/dhY5�6t������K��a�\I�[uH��ΓV;�~79�zA��(7�}��x;g��=l{E�VΫ6ݷx���>��]�뭗ֻ�ܜ�<i=���6��y�)+�2��+�ϋ��A��m�I�C�9�Vr �'=�*>���
�m\l�BZ���W���m?�.[���SFp��gC�y�f���S��I���Z_���Y0*���1��5��3�M�;t��gGh�^��`+b�`�5��2���<i=�v?���ֳy�w�gO����l�9H�����I��ȋ�վ�������XF!�/oN!�g�sW��L��S7�V2<{p��~�g���	O������6�Ő�PI�㡡O�3�eO�U���s#c��`J�b mw޷I��������I�p�U����K�,�/���Bڰ\�F9�u�Z����xVu~������9�z&r"i=�x��?ΊJl������&�-T�6X�H�r��:$U�z�B;GZτ���A2$��!�fz|�B�P����Ts��V�\S��H� Z<i[�P=�g80,cWL�1�7N.+&˘�χ�^�������� �	�aϬb�\Y���&c��#A�6
Ko����#�����4�?m}�Ǔgóa�^C�'=�u����e/����֗X������
�"i�����w����q�)Hv�t_�Ɨ���n��~�<NV�6=$Ls2�iٰP�}t���F���#�"c�x�/�0ğ��~_h�N��ahv������BZ�mX����H���5b�*iI�����WV��~@ӪW�&;��6'y����i;Z@���A|�1�9��L��/��3�EEֆ�MФ"k}I!�0&W Ԅ�FZ�F��5#Ǔ6&�i����O�h|�X�y�b� �>fl����1ck0|T��1����3�2�~����	{����S�}o:��)\Zτ�.N�T\։���>��z\�,y�Ly�}7���l#�wV{%�g⊽��3���6�@��FZτn	�A�ʱ@��ݕ�0ex^��6���\H�0<�U���ɿrnX�v<i}ia��ZC4�t�!�:����;���|M���BTI$�7��"Z�$���be�z&D�0�5��-���3��oGZτ��ȝW�ߛLThE%��PG*0�.���[db鄴aa�"��֗Z���݄Z�l��l�M*Dz�pܯ6h��[�>A��N~��6� ����j���r7S�6�q,w3�d7�s*���6�s*���6�'*s�D~��D�6�'m����/��>#�'���F�@Z�K��8����HJ��>E����.�w���M5*_%m�b�i�W�t�I�]k��װl����`��%�z&�~Td��x��@���{�����0m�E���__dB4�����c�k�Sİ���/��!�����i=�fQb�E5��l�H4�����@�J�6(-#Ï��J�RV�+�D�&J���&�6Q�<l���\?oۈ�����n`#Q���B��V�$�Y��v2iC��}S��¾)Ҵ.��W�'I����X;����#s��L��'�gB����nXj���ڡ�&�ɺ�מ�i�˷ɲ,�6����V;�?i��Ll ���	 >Ű�ٰヅO1-|6��`�b��
v|�]!��=6��J"�gB*BZ��n�T�z&�v#�gB]�2���No���H[����HZ��M5�nN���5�V�~7�
鿛�-��q�B����4k%�v~@��~y�q�
;�6y ?��X۸��ku`��X���k=�~c�gB��Upi���VH�����V���X�8��� �zfk=v{k=v�k=S��Z�,�a�gV��3G�X�.��[E�'�g"'��3�I��I��L�d�z&r�����BZ�DN%�g"���3����p=T�̮��t���4,[$�gb�i=�&��L���56操�uw~�|�׮�kG~w`�s��C���*�_�鴍�й�mH0`���7��y�E/ef���%�ؿ"r����c�L�?ߐ���x���M��7��w�|N�y�y�=/�ݟWr��?��0;f��q2����Uҽe\~�?~�I}2�����ֆ�?�Yz< �  �����0`�6�{�xj��A�l�H����%�n�}c����>��E�X3��B_�Ym��#M�0��
FtDZe��g��&86�vn�{�����}��"i[O��%����(�Ǘ�*i��<�{��+�+�d�q��|^tz�yر�.�����؉�%��#���U���:�q���ؠ�,�*׾*��[:-�������)l\�?~���c��d�or��~�3��#0���i�d�,�1�	��8r-��\��~ؓ�Ɔ~wf߬=��lX��`z��ܥ��oq���ڕ�2�8����p"�P����=�a&�p`��y���B� ��0*�4N8YS�$�	�<iWYX�	��I��ȉ��-���5�H���B� �YM�P�ֺQ��Բ�Dy6^w5���>NT`�­��lH*~���xۏ��Ć����*��o�jJ�0`��
/v�W����*/����g��Ɔ�ְ��ׯO.s���ٯ��_�bUQ�{}�r��kC#Î���C�TH���p��;A�#m��@�X�`��������QF����m׬���,�a�YfÀ%�
9�r�8�r1&%����m���9?֗��G�c*陎�b��ml��ӊc#~m^�Rv��A<62ƃ6^�W��A��~��Ƙ�>c���1����<,`l��m�}�j�X	Ǎ�������[���Lp��\E���?����_Bz��~���Ǐ�#�4       _   �  x��=��0�g�W�0 )Q_c�nm���؍Z��w�����2iZە�I� �rJ
�f�2$l����������������J�d�b�\R��~����ݻq��e����� ,"�w>�>G0s��ݑ-I��)�b�"T��R*�v����Wo^i������!3�b@A���,��L���bJ�WE*ZZ�M�ڧn��������.M��2+s�Ո)k\kZ���Ҝu{��Z:�Zw0w\c�e^�2S+���2��IB���X�US���F�P�J���{�j��(�\n�ú�K�c���cL��w�u뫽�]o����|��>t��h����lF�,����nyۼ�_�6o���{"�AB%��'��洗W��[F��uHm����[A�#���F�V�G�Bg|�f���\&��Ԋ)B����M]�r��#T���w��f����	      E      x�Ľݮ,Ar^wM=�_`���g�.�Ѕ>�A��X� �~{We֦�ʵz��<����ň�����"������/��_����_������������2=��������������/��/����_�ǿ�ez���t���k���1My��2��/��?>��8m�[�{����N��T�i�����Z������}]�~���-����g_?E�����,��w�}��T�4RM��ITت��vv�Ǖ�S�(T����G�9�=�f�vv�#�S�(P����G&��f)z�R����G*���?x����Q���O`̴�ܞU"�����D��m*�;�F7����2=o0m7����\����3'�j,�0j�K������'��+FM��7R���4T7�V��a[���4T7���0Վ�ӈ00a�KaHKg���w���8%���i?�N�������S���;�ED��F7���ޡ&�o
�r�:ξ�[�@�GN��컃�5W����c��*���G�EX�	��}>��|�wZK�9Z��}>��|�aI8'��CU�����1�������7`��\\�ъ]x�}>��~��PہT}�l���g0E:N>��7���>���u�U_5���_5L�5��f�#;�k�}��gv�띿l^o}�Ė��X�@²�a��lRkX�@���l�Z�e3����_̈́%/��/�)}P�d[qd`[��0�/��߁������>�/����cO�ZT��̀��>���uץ��+��o?���T-�1VB9���R1|��m���~V�k���Z9�[J%����Z��w����'Bm������R|QgK��Z��w������V,�a7����L[��wD���K���sxA���6���Vjg��st����)f:N���`,C,����[���V����@�$R��[
�u#D�э
��/~I�7� e�߷Bm_�� ��b���.��o��/�+������^9����DTv[!��LT͵�9:��䶂��e�j���7;���
A�2Q1��|�-%��T;[M�?|�c��m��������7;~c����Q̠?|���/Ej���b�|}��n��}~>���烯uŗ(�j���b����c:ߢ�}�П�T|�y�n�X�nI-��`M���/I*�B�J_4W���5�u���V���$�����z�sI_6�d���u���%}�P�ο��V����/�K�������5}�X\���0�:ށk���$Y�~��x ���I��͞����B_���	B�ށk�����.)X�$<���+�������O���W���=j��)�ᘯP?)��q�~t�;8�wl��{惥��)�߸B=)��-�L[GJ��t}�|��ҝ��jʝw�R��w��΍j��!�qp��$�%�Rn�n��5 �9Җ3m*�GPqМR��U&)w�O��������<�T��E*Q�!U?��⟤�*V�!T;[L��eK�J�-��ƟVj��C�g�/��
��LE�f�OƟU���K�����@��G���G�ϩ+�v�	�u����*,���b��d�Au%��2�JYB��R�	�귋���$4��LhT�^��m%	���]Nj����?�م������V7�B	�rFJ��8�"��F9%mnh���.%�n�	��	�j>JZ��}1TOhT�Q?���y�v?�i� z���	���NXgT�k�?�%Q��zT�K�?�h+��h������ ��#��}!�u�+͒0,���Hլ�'�3�"��F\�"��a�r��~V3�i�Կ��lX<F��l�a��δyj��9h-�n����δj��Q�%�-���;����'I��d�ڪg<���GI�yN��E�9��X<O����Vs�j�"�P[���E�9}-H<O�t�w�u�ky��q�C.��%c���<`呝�\�����i���1���ڿ�՗M\�[�X�KX6ˌ�ΗM<Ji��X��3Ck��M<Ki��XifD�_6�0��������m�BC<�h���o������.�x���S����EW$�E��n���.��P�%`(�Ig����EVB�)�א�����;�,��>����zʂ'A���E(��|�[�Y{��7�Ǖ�����������/���m���w⁊���J��	��/�W�k��'KI�>Z���o�����	��הF��t�w���LG��X�;Zw�/%jE�b�o���|��ǵ�v��7];p>2q�>Cg��ӵ	��b��d��cbM����{�?>�8�`��}²�a��)N$��u�%���9|�8�`��}�Q�ç�3	&i�G[I�m�|5�e��}v!؅}�Eq��$����PmLIq��$m���H}LI�$�����z�v:'��L�%�����D�b }���*�Y��� �$A�`٧a���b }�"٬%h���$I�`I挨θ^�OR$��d ڪ��r %Q����B��׫A�T���P�7A�$���H=��tM$I6+��ݟ��:���zL�}�'�%��b��A]ӵ����vc��8����%����}��Q�.bɷ͍y���(WװxZb�G�$?��E(���w^������E8�.q�|D���h]Ēo�xR�m�8J�E$���G��ڋ�\]D��;&�N=��[��)��!Ӄ���ғ�QYG܍>�ަWU �<*�b�1U���30,��c�^��l��uA�Hi`%-��cI���dTc���U\h����m�Jŷ*��{:2��8Ml"��VIS�9���&���n8�k1�L���L|Ig���_��od�]��byx���mw�;?iͶ�Ֆ��o��v���.D��[��X@T�v!�ްT��SǮYJb9Z�7�V�Բ������8U*�	H����&�js	5��ӗ��jg	�ꚍn8�M�-�>��YW�8�3�q�U��P���.f:N��w^��L����vŖ㹝����]�*ۊ�7�V֫D�:�{է�w+!�tT�A^���b%�UIW������c��+���꽅+�33ȫwީ$���8Y��?�:%���5���+���L��P�S���񜻂�w_�؟x����YOQG'L<��b���g��<@�7L,[3[-�?x���ox.[�?xc���dk����A$���l�^��A8l���Յjуg�_�]�V/z�8v_���բ)��?���v�5�E��D�O�r@�uޅ�"��f_hH�@��qى@щ�D'��T�l=8�(a�;����TQO>������V=;�[XFمGم-=�\XH9<�PG~*��tE��R����g?H�B+��]w]QO�A��Bݿ���Z-~ռ@�eP���-~Լ@�eP���-~ռ@��v�(�v�{K�P �r獿sw^_~Q�>�B�2�]�U��ԟ���w-V��[����ߊ��H��i��;T���S/c��b�鋲�m���;�s�g��Y}�H�%T6}��~��T<m%Ӈ�V��"I��J�T�U�>�a��d�0Z����O	��<Ė��M�ƋtX��L[�i�E,}�R����4k����4P�)��<����ܪo�<oh���֨R�v�TRT��x�T"�*ST�T��xn�2AYj�����D���M
��}�V���ܨXNDL[�i�E=����D��X���n�lt�q�h�xъhe-Bm_��_�	o���Z�|W���������˫O_4�A�����Wm%ct�1<h�s�nq닆;�m>�~-Tװ�dC%Q�xf�Zx�N��:��jg�#4�tU�t<n���+4��4`I��F=�;���aJ�T��z��r=�YJ�ԏo�c��� ,� ߨ�x3�3.@^�^"���)<����h���)c�v*��_�Ҏ����%�rڀ��Qi ���|���Cg�q�-�ū�Q���%��/�-�U��T�Ix�6�.��ГS���/ه���j�b��Kv��u/E�kۋ{�_��t�w�u�7@�&�|�P�����e�ʿlD    jmJ��guN=��)���ޱ_l&y��A���)Xg>/�Q2`A�,��	UO���@(�S�B��{�,2`A�2,��Փgi�qĂx�?��h�Iӌ#D+���H��&�1�H��J7|�\��G(�tP(��J�nTi�q�"A��/�j7�4�8 �^m���+�*����*6���'ְ�sJ�~�T(�Ī��wʬu*���O�����\�S��z����)�չ��B���]�8�¾�F��ԟ�j�b��O�L�z�g5�B�Z��z�g5�B�CA�R�����ub[\�hg5���/�
��^�P�.�yɢ�� o�:��%=/YT�V��j�jE�K����n�U{�4�X�.�v����=/������ł��l�K��f�>�����%��₷R�m8�%=/�V��}�z^0+�q��}��	����G��3�Ox�?�Q��<.�C?Z"�G��h_~6AH�	"�'�����������N��v�^_~VAX�ٵcp���?_=� ����ނ۾X�����g�ZYU�? ��h��>�.�^�@v�n|q}��/�����?��\�U�<�ry�� �Y{;�T�~��E�l%Q��HŶ�5���!�v����&h����?h�.��Va��E��3d���w�K],F���i?�.�agj`ѧ/%:N��Eؙ���n8���X����F�x�Cg���35՘�b��d��s���㵦;Z�Y����d���*X������e���*XR&�����������R>�ds��9�ݥkq��L�!s�4�O�e�8_[�?Zl������_�n櫾�3�?����?��8#e���>�]����g��W��g�]o4�m֛`�t��*w���;[�T�2О������,�2������l�X��-N�X�;ֺ�����@��*��`�-�>�8�l��>��X�^})Q��ئ�����k�q�.p�iՓ`Ye��Μk*s��Z�֒�Z��ZS�����"�Q�k��v��zڊ?��V=��a��f�.���%��=�W,�L.�au�R��W��L�Z5��8 q��t�w��2�TB���vjH������������\l�y�b���~���z3�ak����5}��<���b}R�m������ϰ�X_Ƕ:ۮ�z3ϟ�lL\�CC�Ao�4��P�=�3O��g0EjQ���<���������y�	4�B6�ھ�q�_ydG!��!U��@򧽕q���͜�Y&#�7�ܫ��Cf���鸉�w�v���D%2n�ھq6���,%*n�TO`���$9R��6�����3)��
5�ȴ���$6ҧ/%��*�*@�p\_Pe�I��Ji�ھr6���|3�Uq��L:i-��Ј�&_�Gg�Hk�0E��j�4�f%����� �؅2�JZ�X��T�'���G����5t_C��;w�%�<шװ�^����G��n���?�sFA���Ӊ�l����֪�i��9Q@�~�v����i��`�(����jr��9��x�]�q�ڀ�#�e��Hih�x|B�Y�R5�Hk�J7|�]W���"����!�jV�y��.D�[Ԇ�.mNiv����p5�0��h���+���,Z�cֲ�+��KG,��~�U��[G(�/���f��N��X�	�~��{�����y��PGv�U���<}S�����aڛgV��.q�f�is�Bɗ�g��jv����b�����Q������vևrT�=R��.����脙WI��l�7�T�'̤(,[9�&�
�&;�N�՟of̤(�|�}S!5���S�>��z}!5�Y����ғ+�d��O��^_HQn�o�i.�6��>�%���-�gj(��T?[,�,�2(PrO'�v�X�Y�]��$�t�S;[,�,�.���{;�8[��,�,hPxCG��d�<�P��>w)PӻU��3-t�k߬�[�KP��r�P��P��Pt]��A�*�½$�k���G;�]ͫ��YB*�� ��f^}�Hh����U��W�>R
��nT;Z]���,�,%�h�v��g�5�?n`�}�g��y���WO�|\�d�B��"�v490���*�T;υ�Rq7��O��*�mT�[G*��Q}'J���O �f:��郁I�' ��t@��l<�q��4������q>�JD��cy�+���ښP]���^1����l����qyA��������L.4���엨.�Yx���Dw����/Q]���VM��Q�~��Z���j��Dw����q��X��.��}v�W�z^�)1+�ھ�ճL�P�g0Ejm�]=��d+��]w]q���[5�uL�W-�7�+���א�o��V-M�eN�8�Y�|O-�^�x�a�@4���Y!7˜6��LDCk�c2���f�FX2��ze��8Zt�9mh+����:�G��2��]ȳ�؅�j�S&:ˬ6~c����S ��X4D�a�n��l�E&�1O!c�V]��v�<��2�V�B�<h
4MU����*),}v#{֒g�2I��?��m��ֱH�`����f�jB��������	������+7�5��X���~�"�YK��}�v~W�������_�h�w��uh+�'��Ώ�4|X��`r�������0�9���Giq(�B�Q}S���,�ZH<jV��>W�8�p!��B����b��.$!5��P���:~p�^�����f�U�=�$}�`��@�=�$!�Y˴�����_>_�IT�`�ꋙdlf+��<���ȅ�l��ǖki�,�g\HĦ?��G�껏Dlf%i�v��Hƅdl
%M���Yɸ����C�)���I"��S%ޗ��zT/_�x���z�׳��gP_�uI�2��uf@����_�Z�Ek�h,��8�BX�%���'<P��F[Im�3������BN�[f/��0`q�����,
���'�`�ԇW����c+��]�;Z�r/��O�8)�T-)[���f?v_Ւ��!����?�����!��ըOi�*1@5mX��Y�~G�l����8�9��(c[@�춂��j�?���X� ܰ�}�զDElH��Ǟ"��Y�Һ�4Y�t�w�uE��d��}�J��guJ��du_�GEl]�y>�/z+,!:FR�[��Y��Ŷ��u�1]�~�T��*
��}3�ru�Z
��j��*��� �s��nw�_�w�+(�j|��V]����������@_�6�Ḟ��2������ھ_���N}3M_��\����,�Y����*�Y����,�Y����,�Y����(�Y��Y4�Dd?w�D7G�?�{V�#�;
iVj!���ȳ����p����t�w!�ʪ����f%ё��2���ߞ�b!k%Ց��$������\,d��n,���YF.��V���$���Z��XIߪ.��0���7�+	\5f�P��]�XIݪ�`�ԫ����ּ��n����؜���V�8��T�g�X�]Ivkz�R�H��c�ƍy�ۇ�jT����3��A��e�1Z˦,y�l9���n²9K� [�겹me���A��es7�P��x�l9�ӌ}c��Ⱦ��N_��E�z;i�GR^��7T��N�$סE�/ک8���V}�K����l�RC?����IB6���H�f�U�>ߜ}	�~j���u��u
��#/�=�ꅏ�u���V/{�7��յ~��g���~ųDkyb!�g)<�Ҩ�i=�J#T�UmGρJv���H�U;��T�5+ET;�+�	0K�fT-E�1}��Ũa)����jV�h�'@���i?��H֢F�H�v�j�����n8���Z��� �$KQ��v��x.;Q�Ou�]�����/�����I����f���֫@�#����v~�Ľ��t��?��M&i��^w�y���?�ӆ�m��v����Nڷ0�-��`�WN��5`����}��}��v�Z����X\�^�[l�E־x�~��N��n�����+[9q��z���m(KT1�v#���R��Qe(���AU]-�*Ut_5}�T\i����n    ݶOB��tk��"�%�p���U{zy�[���l�S�Vo�<Y���T�Э(�Zy�ۊ��l�.t�ʷV�,".Ē��������'��sCm_�V�*"�`�ԅnE���SE�J7|�����#<�N1SW�Uçl�_nt^-���Dn���eI[��]�V�$��H��%5/�V��qK؀�)n�Q��7P\�D[I�/ڪG���x��%���9�¾̱(MZIU��auD��zw��3�"�=�EE��{��J7|�7��+o�(.�1U��V\M��v;v_�7���Fc.�?4�3�����v�+G���NT�l<�n��@T�	��l+��7Zng�����jg��񁊃���������-�3*�ȴ����"���D�ɸ_n �[��㎣q�ܕ���)Gs�:�V�6Zqg�����q�ܵ�$]i�VaQ��*��:�r���IP�hܿ70q$GKI�DK�U���.}W�����kO_��+�rH�Q���Y-�J���D-jV��"�6��V����H�3q�d�V�/�_8���b�V���]���ߞ6X��ڌV��P��P�^
o���W��_�l-�6XUQ��o����`U�U�p+����k1�zg����`U�l�ܯO_J���ߞ�&xz����v�2�l���y����Dec񉪟�w�T<�m%S��V�l��d����D%C�	��)�
m4��,%3��R�l�{e����?���;�ƫW*�_�O`�t�W/6m4�A����8�S��hڃ���ߊ-A���(����3�q�]��h���.f:N����fP�!i�F;���r�^���&m���m��^W0k����6�ހ%2ܰmC�z�/��P�vM�#�V�_�,ѻf��s?���6�`�?��UҪ7�``V����~čf(�4�� ��~č���b����>��Ҿ�l���[��!j��齃i�B��Q��G��hZ\�����9I�'TڳT���꽓�f+kY$[�U�ջ'����:�}W�$�3KY�"Y��0��'��ԁ��l-֏�����P���QM%��O��u�?�y���n�����H ��B�kF�Zw|�Ed�ʣ��Q��R5�Sk�nw���E>���B�+�T��kE��=�:Uvs�,.���x���C�4R]������zLT]���P\�G[I�m�_6q+���v!�!م-bŭ�7 �sC��i���ҎH7��^�(.�3l��E���t���(Wl1Z5�j%e����h��|��j����Q²J2a��=.�X\ EkI)��#{\��BJXRK&������Xl+)&��zd�+"WIم\Mf���E,p��auD��.2 q����}F�e��S0h��k���"w�0g����l��Ȁ�GvNW��R5��*�u����������K��e��+�-*47Z�l֒� ��)�-*47Z�,X�@T�ȶ���hͳ�Jz�V�6ɢNs�5��B�-��6ɢRs�����O�ZŦ*t�hɳYꆡ���2���<+WᙪUl�2��V=��b�V����7X�|l������j>\I��ٰl�a��=���x�ZK����zd�[�/X?0���S�Wn���o]�4���ˬEX��ڊi��kGX�����GW5Q�#{��V��mu�n�ŷYl�.�_��^ �@z�7���v������n(�FH�؎����͢{h��[��J7|�gf�-4��C��6�j]8+$���v��}tᬐ��t�B;�]Eu�z]�8�AX��#��E?�#,Nz��$Ç��/�KGX�� ,��U٠`:����J2|h���A�t�ŉv!g�؅-b�d:��6?�1T۽�F������H}�^�$Ne��n����K���;��3|L��襑}��#;g��}�-I�x��:��<�Y��z��j�bq�,�FX��+�T'=KRiD�Si�TAq�m%�4��9�(�U'=؅�!b��Fi��8w�X(�A�6�(�VW$V&�3�"��Fi��8g�V���4V]�D�2�K*�Y�Y�7�k�$-�e!����@,��h-	�h�B�;�ő��$�U��t�⸎�����!4��X�م���s�B,����PG�o�Gu~S�B�;������n���.���u��	S�I|����t_C*F�
Y�_�Ŕ��q*��3@q������:D�UU�R0�ǋI1TU�L��BR��5nU���Q+��]׸U�0�ǡ8-�T]�VU�� u_�BU_��Ӓ�xq[;k׼�s�q��wq<�L�����f���q:�L�������D��f)���ܳ��f��r<�L�w�������3c�O�䈈?�¹g���D��@��W��33R�[�30��U<�L���زQ��U8��|wLCM�`�D�>^�P���Z&�AET|�"*k� �s�e5�:Xm%�h�>��@lTr='�>��@���^�T��V�	�v���צ�Uc���	���9G՘ �`�R�6�z�Y����ڜ���$�j��8�Z������CAT?��S��+�M��`.Xg����cA�4kQ47k�v�!Ƃ�)X΅��KLi�� r��(���z��+TW,�i�!.�[���F��>�1��.�J�ՀT����K�ү�	�P�J7|�]���
��BAH�Z��+�yXyd�w���!U�:t�/�9���g]}�F����w<²/�:_6(�K����%�h���A�]��7=o��/��%P,5_iq��u�]���pbb�����e�ט'v��xb[��e�ט�9ĉ��;���e��N�`[�����j�'v�q���KȪ�����PG-��N�`��rIb�;
'vU�ڥw�+�8����bJ��v_k/'e���Y*��-^�QǮ��Y*N�_������cS�%@�w��J%��\a�Tg�(�zK{QY��.1qRo`��C�/`K�A�E9�[���R�QyA��������i�����������+/3����k�H��L���LRbSi����*�w�� "���띪��YO�SBo�,X�=�X�i�bZ�M2�ϰ�δl11�&�`��R�i�bZ�M"�ϰ����o�a��..l��j��M2}c�#-[M��I���`��Ҳ�T��$f���i�b��M"��O,�ھI��I�|L��N��..�[ߤO,ݕ�S'���7��ve�ԉ���M�d��P�U�Uy����BY�S'��7��Wx�ԉ���M�d}S�..�[ߤM6+��ݟo�oR'+��������E�ds_Յ�Ձ�2�X�������}=�>�Z�![���u�l���KV7��)�Z�e��,��AX��Ժ�q�j���0�z
�U��ɪK����)ą}�l����9���\����.�3�"�����L]R+��]w]�s�J� �z�8c5`�]� �z�8]5�lx7pk#7���՚��븻#�:��w��%�:��H�ڳWn	iZ���"�c(ֱ1U��\my�/��3��� o�i�L�'��v�Z���o�3A*[�BT��R�v~s�	R��jG�����=&l)Y���jg��p��a��Z��q6�1P�V���+ȴ���rD������8��",=��n8����Yysǋ0�:�:��Y����Ԡ�b��d�0��B�u�aFRp�qF�a�5yRi��C�vD%m 7F���zG5n����6�(VU��yi[��8t�XU���9�?��ybU�ߛ���3m�c6"�V�x�?{u�ߛW對n8��qT#'/�a+�H�ʺ7�~Ӛj��Y���j,�1*Tչ�ڄ�8�V$,0[����&��aT�+���چ�8�R�a3K������
fq�� ���;����B�	������@6}�R����M	�8�H7<�;�#(H�)d��/�vT�8u_�W�95�[�M�Q�5uՖ<nD�X^���~V+���1�1,��A���X.Ð�ư�z�Z>~Ô�����ǵZ�!!j+��a[�m.Ղ(�	q�ruvaDaP�?�1�Q���y	L	    �g0Ej�?�!��[IvУ���&�nXy��h��T�,�z��M������Y���el���:�c�dK�b�M�f�>�y*�K��۰��sLq� %���b�UW��M�ڧ;�'�e�������C��:���o#�O��)S�zV��u
�$]Jh��]�Bq�;��\�y�;�
ōS�J�Ԗ�U��g�����`�q���ߺ���=S���I��U*n�B��L���["���7�^Ϻ�X|ܩDE~c�5Q����N%"�+��V��Rk&٩d�Q���Ѹc`��F7^���ٸi���F7�]����q�e���FYۆ>;Q�$��2�x7?{;Q����|�6���V}=l�э��u���-U�eЅ�mTc���ߟ<��g]AWk�ޱ�
LX��@X�
�Zjc��K0a��Q�
�Zrc��K0�J>�V�*�Zvx��0��/��¾J��ޱ�:�X�ɀP�'CQ.�#�m����}3��;_��J7|������_L�t�������/������� ����\?֧x�Ð�����&a���7�,<�"��<��I&]��f����7(-J ���o��ľԐ�}��7,�p���q�����S�#����>�	�5�kB,������k��S�%��Du����ev(�%���C�m�BC|W�8��?����=}@�\��S���[��ĉ���u���~;������E���>`�!�?��}�>�3��=�c��Y-�U3y�<H�l�Q�R�j&��	�lP �.U���hu�YJ(���T��ˣ�A�?����k��j>���O@��,ۉx�?})Q��U3y�4�lt�qꢰ���^0�N`��.۩x��.fj9�jM��k��˼f��,3۱8aFX��%�3[�ݱ8a�֒T,Z��b��Kv,N���b���b��Kv(N���$��:����T�X�8cr:�]؇
��T��U����驍�ܑ���`�����o��kh%�z��z�s�M�ܱ� �YO�TC�PZ9���X���s?�q��Ne�b�6aٔ���[����o��d�Z��[R|�c��9Du�-���١x��J]���o6�2�]�؅��ٱx ?�1�V~�#��~S�>��6�fG��h���Tj�pv(���P<킩�*��&�+��<�ݷ�7��52=%*���4|[��h�`�H%�SM�m}��)*�Py�VO����Kƨ�C呪����� %S���l�.)�o����ʇʋ[Ċo����J���Sx UkZ4�C���U^�zͽ0+�#MM�}�ʃ��1���4W(MV���g^���?����z���aY���θ'�,. ���|���q=�`X\@",)��Y�M#���kf+i�F[��g�,����2�.��4b]��,}�n(�6W�UO�> �I�]��,
�,}@*Q����Y��=Y������؞Eiݓ��?ֻ���Y��=Y��T(wW[QX�dك<})Q���uO�=��n8�������ab���RI�@���]��.UEaݓ�9���-������B�T�������J7�mh�v��j��4=F^m#�v��h��41ƍbZ�ˤkS�^OScܨ���ڌ�ڔ����q�����(�vD�È+m���D�	g���0�Ж;���k#�^O�a�(�1�q�]�q�z�#�����j,����c��9���-{'��t-X��$��sa.�N<��Z�$�IT�{a.�N<���l%iO�U�`�w�X��brړ]ؾ�����Ӟu|2�
��s���H���$�n������s���>Cq.��ZCG�.�8��ZCG���$r�w����j.6��2��H]�)�8_v��&�!���/8=�"�����r@b�
Z�FZ�}�ǣ/(֪0��}�ǳ/�����t_C�HY����y��>{�B��/���<�:� �F��o���<�V���+�It������^��P�K���j��1��Bq����b}�x�P��?��@�2�,'������)#�bq�R��'��<��g���������#�y�g�;9�8z��qu�t��k����%ӑ�'R���x�� %���'۪'�G�X\��$i��#',.##O�6�A<r�D��{\��̷�ڦ�R����$��X��������l-N���N�Q5bq�<bq
�N�Q5^q�<ۊShl��+ٓ��Ņ��v�Q5bq��<�1T�U�w��3�"u�Q5Zq�<[��R�=�w^�0�&T}~l5�����o4�Fu�����՗Mu���v��(��;�Zk��E+�&ʬu�w�=y�%b�=T5QձgO^)������߀%w�L|�?��85���"�Ǟ"��^�(�z�H���u�'F>y]�@�>U�	���3��C��~��I}���e�>y�t/��cO��X�}�{�^���
l-���}J���X��I7�UOΦ3�G(���Jw�UoRO��G,���Nwua��,ꂟ<XA�����}�U�g0Ej9��zD⸞�u73u��O�g�P�����J�+�������S���"ўF���Q�>yW#7�����(�jD,��ի�W"���϶��`5V�RD��ob/D�{���g5R�2D�����*N�:D��F
�ھ�U0M�C��Y�}N 38�馭����������J�kg@Ut4��@-%�?��+
�&���x��v���h��R�p�^%��Y��u�{�f~��n8���( �@d�L��C�BQ@:��@}3���*O�|��~�2�̞��`!����u�����	P��l61�ꤊg	]�
nu�'F�_<Kh��y��%Ӊ�����iB��F[�xb�U��>�b�	D��Bs�.l��GQ�8��ۃC��~ňH��L�Z��QT"N��V+��]w]Q�8��ۡxF1S����F�~�Kۄ���50C璔Hc9"�.�v�j����JJ4>��ܻ�m����h�}K7�K�?����{�<:�[Ĳda�w�j�t��9h-I桵�]�Z&�diaI2����{�L:�����B[��B�L:��v!�؅�)�N����0�j� �.�I���3�"�~�b��$;|�J7|�\�;L&���P�cd����j��^�l�A��P�e�U�:%�o͟P���z�&��_f�=Yֶ=��g��)Ĳ��j-�Ȓ�0� ��힨�Xq��Ҟ8���@�'+�؉�GN<G�'�>Yq�X�T爿�<�c�qn+�����,���։w��P���&V�ɏ=E�ڊ�jb�[���A�������`�(��Xq�z¸(��@Vsd�%ς΋��05�s��LAY���ٴ.2@q���$JL�hZ�8W�v��'ک�g+��AN���;�8[-���F�0��H��j�d4�ܥ@m�W��h�^ks��H\s`$�z2S�zV��耞��ڇL����˒0�g5iV�ΰ��l�a�ت�Ѱ�d�Z�,�U�3,�A,:ATg��Z�a	�J�E���[�FC(ԅ<O�]�]���=��P���u=��H��V�`][���b���=ų0���jbƀ�Gv����kHըκ���Wh^�*�ћXD�XR
A�sfd���"ĒRQ��^�Y7���m%��U��չu�hą�Ng��g�,���>�:�z�����GH\
!�����4l���+��'���B��ό,�(L,�a��P}fd5|�,Ē���L�����҇�w�b�A:����;��r!�[vKZ�����	G��r}&�j���j�J/��H-]O6��g�t�w�u��uhU�ۛ���B�P���b�.�@hV�!��o��Y-BnŵK��<$���WUW-��P��*˽�]�9��:�2	��l�#'�Z��,�p�˦:�q��u�en�T�4N2����j�bH�$3��Ǟ"������/�������Ỳ��ߥ����R�K⹭����Hտ��0@��;�������qX�DƝOv��l�����c,�&�� g`�L�ڷr    $ѕǓ�L�uŎ��(�&�� ^x4`��<����kHŮ���{>�%#��j4�U]�^��N�l�a��l��y/�Fa֒e>h��eS���?�"�vֻ�s0^2���t��/��N�x����e��|}u�Ћ��e��t}u<ǋ�l+[���}�/�?�eQ�/����x��A��j�bHǋ���H=kU��b�[���"�8�8`�AT6��"�8�x�"�j�����3���YUCX�%HXg\�gLX|�Ckɗ Z���x��ŗ>/A��q=�2=@��<�J��V=�Ǔ�/X�̳�k�]��z<kz��y~c�#��s�$���g0E�V���/��g+��]w]1k��~��/A�j/��X|qO?�/�j/���_�i��G�~֫�T��v
�J��#b+��_�Ϝ�e�(��؊��/4G,�D�GDua�kIT����/��¶/4���?"��^��\���x�T׵�x��<�)R{�T��/��V2Q�DT׵�x�8[*������@�k�խ5�^r+��'�l�P2zכ�Dڀ�W�e��5	�	��/��kB�L�~������x��<�T���(�y�����&P�hz�dyUZs3K����s���Ui�M�w�M��#�,��*nƴ���-_��*+�鳷'Z�leUXo3#5�'Z�lgUZnS���\�n�lmUVm3�DE��'&/n�l��{��~�bg�K$w�eu��]�W�,~���%u�ֹ��]��aI���΍���e�b��J�4h�s#hQ1�����4�¾;��y�䎟����+�E^"��g0E�k��Z�����J7|���Ɨ���GL���#/�ܡ�b�����y��˶�ի��^��+X�B�=�-�V�g�h+�`�R��'(�����ہmգz�d��..�;���ϊ�6�Qw�a��CQ=N1^���X���E�8�8 qS�23u�U�h���U��GmUg�l�u��Y��<}��՟�w�}��i{�{К��'/�y#au<}�jG�<�&��=}�jK�;2+��]w]�!�)~�U�S��q����C�;ջ�G#�DA��jg�F��$ӑ_�묑��i,I]�W=�V����i,�]�W=��5�x8� %i��N%�ju�x
̀%y��N%?���dI#�Ǟ"�bd<f@�,q|�b3�f��=��(�$e��V����1���تk$�;�~±�����X�Rq�QY;#Q��q��J%r;��nF�jG�����yh)ifDK�����@�z�?�c��)���P�h�
[�i?8Dܡ�O_Jt���"n�C�p\�[q��,2;f�>F�:��_�\��b��d��p%���w�Ÿ��[ܮ;]�D%�w1"֙��[v,�I�]�l�����v,�I�]�H��Aq�� %�����m��Aq��K�ӰE��]�ϴqb��{��(O�T,Ͳ��������ƉI���Ř����X8�e�)fjy��@��0jҚ3T�.���P�\:g��vAK�7=wq����y����A
\̹�$3,��A
\̺�$37kI?Zk�Ju;��\�l��K����������Y�KYչz��V�~Y�u�����f�
ZK~Yh��˪�՛E�BX��"�s4bQ!9�hm%���9����'~
م�9�.�j��,�~c���z�HV�L��ȼ���E��V��Br�x�C�ꁩ�򽨑�EK�ZJ6�л�Y���o�~{�-6=`��8�A�X��٪�M䣵�3�mյq/��}�k���4�%�w��|sy�-��|}E��?�j�be�,�w���H}?[5����t�w�uը.�w��ac^h����E���~��]]6@l��������G��R�� ��T�l���Df�A�v4�IL�2ȧ������W5P�� "�k;��w�@%�tf3�'���Hґ!���D�x �A<1�����~�L"0���q6^�~��컘�8�z�Qˮ��l���p��v5�'r���B35�jZ6�ھ�6Sî�dS���^���a׬t�w�VQP2��Ƥ	�ھ�7SӮ�/����I~j�=��|��0�G{q��̪[���`�����3�n�ZV{ k�����孌eq��z\��
�P����V�ma�� �?����Ua@� �?������0 I%+��]w]q���V����T}�zz��� *q��א��)�W�׍�/[P�6��bòla�N������֒tZk�j���sK�	DuN��Rݚ�$���:'�UC���)��O�����#�a�}1�m�>��H}OM�^��|�J7|�盹p3��(�*0���l��vJ�}�٫?t�)�Gv�����;�b3k�Z^���<�b,[˫������gj+١�!���l��g�����/���4�L�)R�ջM=3+��]w]�� Ky�*T�7�,g�}f�o�X.<�t�o����y�T��g���J���8��x�ETvDe��5x�3.��CK�p~��3.��c��|w������쐊G�[@/h\Da�O_J��yq<�"
;������*�����g_�T��$����W$�.�e�W��gU���OW,�&��^�|������Z�{Ak�wL��?`q>��$�BT]���P�M@[I�m��lqw������مMp�X�����г���s
��HM�p$���n���..�Py��	�SC��O�M?ߏ�ji�Y��q{��5�â�nXgT�ۛ�1$��h!�Y�G������1Â�nT=������V��V=�/ő�kJ�xpV;�?���5`�����~g�V�C[Ŕ�������V1���H�}5�u�EL�T��9#���"�\f .�6���$��R��<�_�m]lS*3�'������`�W��<����Ŗ0�X���ʣ[Ѵ���}���g�x�Eɸ�6}Uw�}G�vc,���z��3C�e�b�:m�j)'��Z�*Fk���j�Tdv�%�b�:m�_���V��c[�jM��$2;���P��E$v�cO�z��X<ZDb�V��?_��Dd�P��e�^h+V��١�b���azW$nx^��s��^qr�2m�g��J�O��������IT۽�� %��S��Vg�8fs�.lq��l|�W�����Gu���$f$)$�Q���;��I�HyTG3�,hq���=�%7����,wa��b���-Ή[Xk�>�����4WUN�K�a�ˆ�~��US�ҫ�֒�Z���V�]I�a�ˆ��-m�_�O���l�V疶j5�֦�9`�{Īs�������ܪ�\i�g0E�/�jW��J7|�]W-�J!C�ˆ��˦ZĕBt_շ�U�:蕽xE�:���}JHc��*`��~��i�Pj��G�fj?�xB� 5�'��N�~��u��k��\�w �R�+k����4���ڜ��|᥍����ks���䰵,��amNQp��Ĳ짯�)J���ö�ڪ��V��,<(G\(���|�se��#�a�}�`h�19��H}�O�$�䡕n����8@d�Q9%I��|�CD����6�jTgA���;f�����N�]XD�X�j���i����Z�j��割���ZM�c�<Sva���J��5�<�ua����c���+��Ǟ"��/X��O(nMe35��+֯P�U(���acS�d}��C��tH��/X��;y	w�������Π�°�5��~����4P���ՙ��&Ϡ}Bm%��h�3�YM���bw!'؅ߥР�C�01�P�7�3���g0Ej��j�l�����5�ů��{��CL�C��f�o���g?���F'ߘ?�����W�j��o�	�71T��Ym��5Z�L�U����%�D�}��Zm��5��L�U�m��!�f��B1_��n�XE�O�������2j~��U��@�f��o����jK�b�2Z꛴�*:��F�������U֕��u�����W���ZK�:Z����
+�lC,��D��z5����6���u�U�������ą�م_�V��>�?"�Z��>���l�b�EF��9���^����Ԁf-z�Z���b�    �Jj@���P��ɍũU+i�V����ɍE��Jj@u!<���>��(=XI��a�&7��K���ݯ�c�VR��n����(;XI�P�z����(=XIh�of\��\��e���˦���L²Q5����)?<�%�j�Z�˦��TQ5Du�l�� D[�\��WC]W��&?�j�b������Ǟ"u�[������J7|�]W���H4��y�L�}��\y*�/�����J���3?>�E5�*�{De��D�Ͼӧo��@��/f�jG���70q�
-%�h�v�]�(�ҷ����e��q�]T(�Ҷ�T�E���(O\�c�����8�.*Wi�C�p\�[Q��J�3qb�����2q��=�]���mqak@��^�w\��l��b�ai^֧IV�(VQܡ�,/��$�}�(���:M��E���meyY�&Y��XEq�.���O��vR�����0�ھ��?�)Ro��Q���t�w���C񻆩��:)Dq�zsG5��P)����ƕ��J0E�}���ƕ7���n�zݨ���nP�����y��W��z_j����A�w^�>��,�Y�Uq��,�IXgҳ�����h-Iz��zҳ���9�%IO�:+��_��a[�|n��Y�6+��q!��؅=bU�x`�<�1�񲙫�
<,G���/���)����5���&�#P��e�����w����f�Fu�_�|�s������&�9}M��N�����ΗM<sz��r2ZK�9�Z�e�Ts���,i� ����g>Pܑö��;۪/��V#Iq�?����m�+���Ǟ"����^ Rۙ�n���W�GIo�P�7�T}�O�@J�;s_��+���}��?
r6nx^��[��,�IT�l�	0PqJ��$�IP�h܊30qF-%�O�T;7'T�b�qb��w����T���0'�L�ɸ=a �$??})�q2�M�8o�6���bet��v��	!�:�ƽ	���w1�q2�|%���K�ا��z�7.2;��7Q���߹���V�A[���_���J�0��0�߹(��R�AK�7L����b�*�_�T�{�(��	���7L��"�:~�R���Q����mt�q���z_qZ)F:NV;�6j�{>�g&ζ�5KT��l��,ɶ ��Ϊ���𻘭���ֹ��8q#m�`q��z�D��0@�1ۊ�3l��,2\�H[�.�D���U��o�Ӌ��PG�D|��"��vy�����>�8��W,�8�U��qh���֒�Z���^�[���?Ē�Q���t(�:���ꇶ�!������.�������aw��z2?�1���+/��g0Ej}Tq��ĕd���uץ��J���}TB�����+��;����i4���}C��v[�x�Z��v���.`��dXRu�lDuN����ys��J
�.`��QXR�lu�תcRW^g'?���ת#RW^e�V���b������6�j�ꄕ�ڱ�b�>��U6�0���z)�SC=�TR���- �~vNmu�YQYyͮ�s����@sCY��jg��53PI�憰��w�]���@%e�XW�L��%����D�
��ۉҗ�@$��\U�Fj~K�z��o�
�8w*TRl�5軃(}�D0���1��`�~Vq[�E鰁~Ͱp
�`�	���y��9��ES���'8��
����h
�٪'8���K�a�������B��k�5N6�#��5H0[Z���%8��	&K��n���.nk�`��B�`�j	��������O�9�Zժf�A,�?�a�cU5l�{�Z�����[lK����W@'��t�YlK߃�X ,��AT����B���m��l��2.�{ą���]آV����	1���)�pY�#�`��^8�.K{�J7|����-�{���0��U���=��)���[R&kEZQrDGU�o���/��qȠ@a�P�_T5��:��C�_T5��� ������*�6Z�#X�����`l�a��]�r��>����F��K�*Ę֢�hy�Z˲�Ę���hy�aYv������s[ɧ���#�7���>�j�����u�cO���ߢ2ri�Z��ݼ��Ρ�3^������}1T+�UG���H�ckP:ս��o��G��F25*^��u7��S9�U�T�-��nP�r����#��RgWj��������}�Jūв������@Y�O_J��y�.�xZ8�]���&�L�-���P}�Q���[f���wm�D�H�˧:�v�n�k���Ê�ҽ!�c[��?,�`[��ձ�3�l	ulՎ�_2�,Iulf�v6���dgH�cS�g�/�+�1�	�����z��H6�d:6}�v�b+�hƎh8��y�vV�F����9a�E��΋p��o���9ZKn�h�~��X|A',�
U�
ǫ�(�����¶j��x�߀ŗa���PGu&^�7 �M��)R˥?�R��`��n����Y�|�3�m�����T-��,�\@��Z.�Y��C��Q��ը_>_W,gFu�:�z|��d�m��Zg~�XG���aT7����� %cm�V6��lu���?2�!}ٸ{+@���#����?�R���#����?��7.��t��e�f�+V�d�C��q������<��.��eS�"q�n���[w˳+7�	�|�k�nyr����K�#��C"���i�=�ھ�[���N��)RK�V�Vn$�3+��]Y�!��N�xH��ȖgW�����CM�̭���=���ǫ�g5NU�Ĵ�G�$L���L��BKI�-��W~��G�����W��T��A*���6XV���@D9��E�j��v���n8�8�.�����L7�8������������鲞��;��t��5Y*!�]�ִN�y��]�Q�����VZ\[��� j(:H�<h�5�`�IWKF��*+�T�I�FR�"KYq�,���*�+�/�R\C�gc�@%�,�1�~2^�0�������89տ?$�0�p\�[��$f��8Y����R.�ި��q���Za��Cg���@�����d�g����*����h���\�U~��/b��K��|�eob�?�p��P�gʈ�,W봲zme�b��k��z�](��E��z-4��sCm�Tke?�)R�jW+���t�w����6��W���Ӧ�+����3����N�����嵿?$\,�j��D��D��������:'�g:�Ȫ�5���U'VGM�Ȫ:²	��u:�:j�'���dB$Z�;1���x�aɄH��7��k�
�S��V<e�mՇ�����3���Pm�Lz��x�(��S�>�8�燇���n���.�P7@��m��	�L�^��+�<!�א���Mg�`����Y�,�f��n&P��P�v�*�|@ �}lS;Z,ϼ����d�Zd���U,м��L�'�u�^��W�����C���h^,м��L����b�M-ff����*�d��I�����"5���b�ɋE�7����'����Z��	�tF�r�:ke[���lEj�U;�N��@-T$�v4-׎L�1K�.�,��)��T Q���A��
4��h��	����Z��::�R�VX���@G�6��;ѡ��;&0�"���n9G�V���A�@�[�I�>����Nm��ɋ��[Tu��,^�ԯQ���`+��]w]5w��%���j�f��o�`��P�&U����V��kqVy�Û�D"�e:]�5�=�#�n���Z�;7N�X���EXH��s��� �y�",�U�ύS��n��ą�A7~X�ڏEX�H�=o����	<��+z޲.a����+z޲	�K����⊞��GvN��k�_��l8�A�������K6��� �wdQ��9kj-[��� ��3�0hͰl�΃���|�L3��,��0�(0zO��,��?��(0z�D3���H}dqj�F���n������|�T3���k�A��ol��o&g�I|1=�Ǎ�	�[Y�{�����	D�;M�J�{&�J6'T�ռ�,�@K���T��    W�c��ǳ����޲d�pm2mu1�[�K�ӗ'�b����@�p\�[��'�%��w&0T�U�}�^}35!]��Ż%��F:h�tP5�K;Q����7L5�K7�J��h��h.�xD%�s��o�j,�N<�����R��V��U���N�ߟ/ĵoi�'0fھ����O_J��0�h.��h����M,�6<�R��by�#ߴ��� y�M�rG��w�Y�v���٧Ǻ��vV���U3��kX�e��u6{����kXh-��Gk�f�4t�"՚`Ia��za���e(V7��dڪ�,�ӬԀ�M �B�ٲ���435`�C~c����N3Sw&�3�"�z�;�KHܕ�V���4+5@q_Cq���Z���f��<�s��א�Q]kq���՗ͻ�I�&X������e�Z\o7k�O�G5�˺���.T��Q��[�A��MxH����t��,�',�z���^&���<f-���y����,���s�Z��F���V�ㅶ�����7�Z�|�}1��Ms��Ǟ"���Z-�Ѡ5���u�U�k4kM��?��<�jq�ƭ��b�>�>��L�'o�[u�X,�|\�dl�)�D���Jȁ�%bDe�tmJe,��d��)�h�v6VBT2J�ƔJ��q6^;P�4�xJ%2�'����Ӎ�T�զ+�D2I7�R�Fj~��W�Կ�L2�W�T�7��Jv"�S*�wQz����퉿o.�?�ާ�:�w,� ��o���.�����֒�VO4�!G,�$�tpUO4�K!G(.$����m��Sm��ŝA�Bn`�lU�r��� ~c�&��I�v$��g0Ej��t����mAh��뮫i�v(�
b(��`��hL,��ۦ������^-W�cq�",����իe�w,�Vh-��h�ً����aId'���T��P��V��V�7����������!j���c?�1T[�\��H��L�ZJ��)��rԬt�w-%��U�v(��2Gv�j)�G�({�b�U zsl�Z;'`b�F�|g-���*6�mH�z�,3
UlZ�:���RYd����L�u�Z��2�UlJ՟�j�T��*6s_C��JYŽ�y�m?����j>��)�5��Yh+��v,�gDkI�,Z�,�V�U����M���n�V��4�V��ȶj�!'=`qk#��c�#�ǣ�$��{�Ԣz<Jz@�vp���u��^�;w�3�ؘ�E�x�􀕇Pn�E�5�j���{���E��Y�V�u:�T\(%*kS ��ѺU*���t)T�R�u��L�g���^K�T�P��`�T�f����;��Rq�	Ra�2	Кje~��N����7ZV���mt�q��^e�f�	��ѼJ�M/軘��be~X7cz�lg-j-�kf��՗�UK���H���Y�/��nY��_��뷗���?Y��Ʋ�]��+�8۩�9����C��9�BRt�]�x7�7k0v,���k��uJYJ�Xr��5��%;�]�Vr�B[�UqZ�ŗ�x;������KYM*1+���,w$�.�����۩�m��M��;���N�ܱ�W_blxuZ���nT^�,_4�.T �X򡕷!֯.�Z��d�8ݬ5}#ܱ�S+nB���\͞�X2^�n�:�����%�����^T���D..Oק�.ܑ�+m�'�.ܑ$����|! ܡ$}��	���p��#�|1Kkj�����Z�B\|�u�ꏜ'*�S�Խ�uA[M9�c������+h�)�v,~-�����֚�ю�X�Z&,y��9-2})_�6~���8X���*��۱���?�j���v$~��=Eꂶ�vlG�wZ���|�ۡ���P��a��+�����}1T�Uç��eRˡ5KU�e9i�T����*Ҳ���Hji�/ZO�O�z�����F�o�ϫ��.kOФ�_��Hk�˺4!�ײ4��;��s�$F������y������Nÿ�v6��T��T\�A���0��L�gKq��-������������/n���#a*�:>���	�0���H�=n!����V����3@a1K��M,T�=������}������=��{�E#YqDX�uLX�u�b���ͱl-�:Fk�u�b���ͱ�%_�Du���e�'-�U[����ѓ�c�Cm_���+?���c+����V�ỾֶXurk�@��1S��������_�辆T�O�:�n��g5����+w˧�m��yƿ��� ��m�Z=���,n���U�yƿ�������j�.d���,n�O�ۺ[>/n_���?�o�O�T�}6?Y�*�`��R�q����m��[5Sw]m���du�@����^OszW���Β�{=�i�+/�[��e��՗M�r�I����~�	K!O^^�֒O�ֹ��Xy��:ĒO�:l�rȓwĉ��ʶ��M��Ic��C�[�l���u�cO�z��X�}N|-F+��]_�V,�>ym�@�'S�ul���Wױ�b����>�y~�x��T�~��gqe�N�e?�2IQ��ť;��J$ՎW0�L\�CK�$-՗��lOjW�qݖ�ז��lO�7*,�!ӱ,�(d{R�>})Q[�S�=��l$�m�R_S�=���3�50E�ؓ;��%_N����p���Z��u9F�[`T����d/�Y2ڪ�݊�������v��,yK�w�lƸ!KFK��[�A�)bi��lQY�O�IA����L�ɟbc�S�����D�ɟbS�S��h��k~���T��d��ʒ�
ħ���w1�q�X�}J�7�V8�}�V,�8��B��Ʊ`��X/����8T���jG�pe"Y�YJ�0��Ǆ��cB�����s'&\��v�K�h`����_^W,��ѝ�Xg�D,��ў��:W���a��OѼ?�z�D�P$�S[���V��1�x�C�
'?�)}$��[��~ �/��?F�V86Sw]��5@q�F+�P���x-逕�P�p�V�X�|E���5=�G�����y�gM�v б}£�	�k��������z�?Z�׷��������]�s�3���U��vp��h��\O�����g׎���k[M'��������Q���M �����Ak�#Fߟ�vӧݥՖ�}�_\��Z�.�3��{S�/��nmhշ���3<�\j���:�TL�	w��}�U�9�T&N5y1#��Tyb�SMV̈��\�&���ny��╳�ܑ���ň��H��T�(��b[I)ڪ�Њ	���r!�4�TW��'��bKI)Zj�F�9�F.��!����Um��+��	����U]��۸��K���UU�ċ��F7��V����K��}���o4�o�b��P]�V�漋k��1��G�<�䋄b��V���d:���%X2���|��9ɻ(a�����l>��gyƍ����"[�|2�U�O��,�&�g����3"$�$�g���T�ZN�ъV�A`6��/��d:���,Lբz��w��C���,�x��I:Z���6��F�j}ebabi`�N�L��K��Z�E�:KdŲ���8ĲN(�:Kd���Ĳ8���B��zT�&Ɖ��]�U�gba�<�1��E�gbQ�<�)R��K?���J7|�]W��O,�(�B�>u�X7�X����j՜F\��'��Չ�O��AX���O���ק��@k���?!��_'��AX���O���׉����$2����Ifk�>�ھؙ;�\���H}Afqh�$s5�J7|�w��fO2Y��$�������Ifk��b�>��>'�:?�#���ڇQ��;I��zcQʪ�RҒ�Uv2I�QY�Q�¸�<g��?��;��¸�@g��?����R�7�Ɖ����y��ׄqEa�$�H�}�t㊲�I:��K��0�(i��mt�q�'�Dd&n�c��lU�8I+"�.f:NVE���n����U\�Ǖ��DT��!�~6�1P�{m%o�U;�����GT�!�v4�=0�[-%o�T;O�������@��;�ƃ+*~��3�'�W"��O_Jt���VD��C�p�q4�X10呓c9Z�     �FMY�2�^�*�~�?�k�L�z��c�|!t�+�d`��5Z�'����%Ccr�5Q�$P�[�dh��5ڪW�	-W,Q�e�·��բ�H��9�����V-��w�����I�G�.W,�����Tr��h,i���Z]�Q:�*X�2Ѭu2�G�N�me�Yme,��d,�P�����<<t�U���PmfQ4�X~S�>���d,Z����i!v��(T}fQ�3�nZt_5}38t�@����wJ[�.v+��h�e������W;�&$X��NT����8���������m��NG�N4nG"1�����f��=E�s'�CC'�cV��������('d�j�f��D#w�}1T_�V,���qp���csy3E�kD�D�K��J��T�U*y��{?�O
R�|Ԅ:f��y#�R�7͍e$�(TET�I�"A�ЫD�=�"�g�D[%�O�|	���bT�$�17�0T��tË��S&�C��;�kt�K�Xm���Ȼ�h��O��*8z���Fڅ��Ie�oj�2�э�ڪO*S#�ȍ�Au�h���Dkt#炖ZT�Q���Fʅ��d��a���?�1�!�#����?{e9rD$�<߂Fj~o#���n�[j31r@5ɂ�9���.�Lx�Ɇc²�a�J5SX�m�֒�Z�j�N�����$�BT�T3}'_�^��m���	�U/���5���cv!'؅}^�V�8���a���Ky@��"?�)RW��o��S�h���
��<@qCq"����4}+Xyd�D�O��Q��EI��ln�8��iDJ۲$)�����^oO�� �W<���6:6��S�#��GV���l�� �D���ڴC�K���\�$�p�C��~�b��߀%�Bh�s+f�^�x�bY��:��AIz�F���Lz����%�ظ��,0B�Dl���~$aӫˀ$Y�<���zf8��P���ՙ����ˀ��P�1JT�����ȏ�kKſ��Fu,�ֵ�E�5�¨.X��'�w�FWnYol�\�;���q��G���]CT�� ?�D%���ڂ4.L� ���M���ڂ4,T|�a�qe�5mA*�� ������w�+����K����-��mt�q�o�mj`�/?f�wCg�>P�e
}3M����8��^{�z�����,�OX��%��5$ŏ�	1�Z��Ek���������%�X�:ŏ��0�V��E[����<	1ԅ��c�Lz{�b�C����XJ�.'��L������rE�V�e~�ٗ�����oj�b��_²a҄u���oj�⹿h-�&���ٗg���x�/a�8i��ٗg���x�.ۊ ���'�3�~X<k��1ԑ}y����'��=Ejٗg�Z�"��֬t�w�u�Ky����ӛ��e_��ky��C(OoF�5�j���#u�F�vֳ/iH��9H�'X�}�'X�1kQT7k�"�4RX�,��Bu�0�X5@���lEwP�Uϩ��|F�!`�]`a�;P��j3qA��?}S���f?I�gV�����w�"��B��F�����V��ec�kHըN�:K�[��ɕu��N�,|��ʺ�h���J~�:�r¡���lr��j��ۏduZ�I�����#Y�Y���o>�)��)�\'І����$N���8}vA�Aa��yL�0���j���Z�Aa`T���[e_2j)�䩥�%��[�Aa���?�_�*�R���B�2���U������iD-rՇ3��F7�g'T��W�3�qӡ�/��3(�w1S��V�D-����YK%ķ��5��T��#�o5�j+Ѱ�56�U?_[���v<"�<������J4la�M�����20��--�������2P��-����ڨ�b�{�v8"R��NTlW�E����g����"Ѱ�#"�Hm�n�Ui�t8"ҬtUc9+���s���M�[�μP���/p�QD�%�/�V]�\T �HU�|�ީ���5�U���D*�xA�s!qUi˲H�7���&]�Qak	Rq�BuEyUm˒H���������[�Y)��n�_S&�'�,��'0f�d�oD�jHy�R��(O��!�F7׺�ű	3�!
��B�7�&�,�d��P}#q9�����nt��mp)����[�b�(S5��W�+�Ae�(6�5�b��,Z�%�嵳�hVl�I}(X�KX��fŖ��ԇf-i�Ek��ڣ�4��P��-��zM�Ql�I槶�����+Ŋ=8����c�#1\m_�Iy�?��7�[gR��n���􋭋3i��:S�F��e3`�!��:��nʙ�{xy��J~k���\3
�t��+����Xd;Pa6��K����Xe;0q�.Z�3�l�v6��Tܣ����S��q6V�T��B*�F��d,���	y�R��d<d �����ߪ��O���<w:��:�p��$���s��X��g���Ev��c�N;��gJ��1ӑۨ~�S���S��ۨ~�S����㾙r8Sg�Y)F:NV���)��������xnɬ�sZ�լ�a�#�p��HvV���ڳ��f���g���C5Z]��?�]#�G����o��Ů����z�����×�@�7|�bE5~]���Ɠy�k�"�]����S�S�X_� ���϶���?_E��-�����������ُ7��/�δ���x��s;�=L�<�L�h���	�l���w����UӴ�ͣ�D����8M;`q�<��;�م��U��s�<b�� �E��z��a4��HM�獯H4�Ŭ$�h�^R���|�R1T+)�i�!������G'��w�kN����3�:V��K��Z*�k�����u�Mz0'�z���_7�%k��-`�z�NYF�*Hs�V&�%[��M|��D=�.a���n��Հ%
21���t$Q��3�"��Mܧ3 �~��t�w�u�B%��P(�!U+���:V��Q��!_6���ܿY��~V�zQ��Ȋ!�2�Q�A�(CZd�Q�䀠�E&Y0���Z����i�X�����u�_E)�"+��
%��v�W�X��O_J�zU�X��6��ΫL,�`&��P=�W�X������o���[A��<߈���٥*���
\d����KQ���e�7�g���KXX)�X�CX���b>aaQ"[K�a�Zg>�X%YX��XR�'��2�&9%���,���o�j�ca]���˻����~��#?�1��>���$�`�g0Ej/�x�߀��h%��h�3�WL�.���-C�|^5��4���n,�����.�T����	�Z�	����^	�Z�"���q���k!��`I�8Q��^��5�6�ǍC�1��A�������o�	'�Z���7�rR����e��c��"��ʾ�}�P5-4�vR](߁zc����5[E�I}c���(&�RN�3�"5MDU���tҬt�w�u�$�B�I���x_}T�,��4��P=%[��i'�K���C+NZH�����	�.��C�\�]����K��Z�B��������[���\hW\��ؖ�}�V}�Vq��b{��>�s�k}��B�;���H-�Ǣ�I���;}�L�u�j���7��0U��V\����x��o�b���S����l�Mg{-E��B=�B��Sg{U�-�Ύ�,x�l��ڸE�١�l����.�[d��O�����.�[d�Rq@��^եq����/%j+ڊJ�E�ء�n8����t[dmZ)Fj�Ъ�Y�������]8�X>P�D�\��T���S�Zj���i����ͅ��Hes��:�ra%5[��4j�uu���Zj��Ӯ��L˅����Lǜ�rL�)��zR���,˅u�l��k~�ޡXI-L|3g��lu�����kz>��&���yUQV˷0t���Ot���ZŅ�Lm1������Z̅�L�� ����jU4}�����[�������~C�g�6�|Q��¦�O�-��tU��Φ�O��6��Z���Mmvӡ͟�vX���j�К��}iΆ�e=-��V�4xiz�ur1�u��<OJ�x�7;�PG�L<(e@�W��"�晸�p@�Wh���K�� �3�ǃ1U�    �s��+V�>����})��^�h��~1}�
�vV�.�lҀ�wk²��:�.�Ҁ����$ �Z��"�*X�-!,� U��7+P�,A[I
 m�_6q�k��l	��?%م]8Q����0�:^6�z���%��H�e/��8U�V�Ỿƾ��}����y �j/�8Yy������l�L�i���Z�e��l���+M�,]e�/�j����A������M�e� b�*{}�T��W��D��:eŔ���Aq�li��M��dM{������������H]P�ˬ,�c+�2{������zl�����[��g^C��j\����+��!��u��U^[�Wn�ckq\gk�������u�Xב���t��/��u�U����_7�B������M�w�sCq}*fbV�<�g0Ejq}J�Հ�����u�%L+�
�l���l^�eo��#;�l�}��I[�|��#{��2���o������q#ƀ��8��Q���a\�HYl��:ڪG��c�ba��s��_(f�V��!��(f�V��C�MO���J�E���L�7=�C+��-^�P}�S15���x7��1e��~��/E��J�>�~#,�ψj"mѳYK6Y��~e9E�
�gu"�pԉ�,�(�XA�lX��1�S�SQ� yV[�Gm�5�en���?�L��5���^&�+އ��pz�'���{��}3�����B�t4�}h���}��D�s4�}�	�}�]0�ƣo��]���G��Mq�р���'u���=���{A[A��������u�օ�Cwe6��ٚK�֨�Cse8�3]�����{o�=e6-|E�%2덡Z����6��glPV;#�SuW��AI匘�變�e�����N]�Q��U�<����Z[g��A�53D:v�T����]
��W����&��^�2q�����P-)P���^�|�]��ӪE��0��韏�*���/��ߜ�ϐ�
��*P�H��>�����m��?�l\���f�ES��W��G�q����̴(u[����a�a3�G���E��z������c}hQb�^��㷟S5auQb�^偟muˉM\]�W�����[}۾��W��g?��j��jd��4��j���4E3�Kg�i���4%�E�|�Z�lǫ6N�|�0�jTg;^�uJƋ��V��َWԳ�2a�](s�Ѕ���#��P�7]2_������U�ae�Z��z�F�Vf�0���C��yQm���#���#�5�jT����1�a!��ը��vr��Ȱ���X�{P��\ 42,��!U��j/Ȍ�V\Ec[�����s���]8Fwa�jG�k��
uD�����E�a�f�x�� ��u�C�S��������*�j!4.yE��W��R����ܽ���C��gīl-�V����(��C·6�T�I�"��\�]�0J��n���/�8EuM�CaH�>�2�+Xy��v_C*�Lm��L׸����P�*m�KT�tJP��XTڤ-%=�h��ӡH%���?�d��jx��a�
;N�i?����D�KD<�����i�H�CK�F7w}�J���2w�2�q�U,-mҗ��������`(v��c�F�l���Ku^�&����#��fWmZ��rb+ݭ���9�+��1�j��G^T2�'l����Q��Ҫ���|��x��@%z��_+ U�m�*F�B�tL⬖�hK�>})Q��Y,�m���ld�����:w��,f���8Y����6�9i��׳�Uw%�W,�����L����Wf�ZR\Ck�4l܇<`qe����FT=wP\�A[Iqm�Ӱq����v!h؅]����+4��PG6�5�"ɒ~S�V\���$����n��/�.�"�dECqq��Zf�]�G�ɚt_�2��jT���rc�ߢ�����v�N�SĲ�a�_4qqm��H��wvْ�Vn~�`Z��9�^~�rO���##�J����,��79��D�����A�ޗf���,ީ���zߚŏk?A�S�J��z_�ŏk�x�b	y�b	�Ú��t�q�F8�����',�y80M�`�Z�q�X��p`���^�q�X��0��A�~�^��-��L��և�q��@�	���|jO�Lr-i��?���魅��1KڽC�s[�E����`T�#��T��]�X����v4ɻp5ն}Ż�k��oӟ��<J
Qiw3w��^�D%͕�qw���m�s��tW���!������'&i����c��o�����g^>�N�{}��}���y�;Y���Z<JJV_���eZ�HZ���]���G�L��A��M��|��aR�]���e�����+8�������;�ȶȸB����;�ȶP�ܸ��O�|f[(p.���E�v�ʛSV��G3mE�U?���{⣙��2�cL��4�B�s]})�=�w0ŶP��8�E�m�̹b����}��Թicڳ~G�r(�}���k���������P�"�g��֦�G�.2|�P�pl�yt4�"�g�)��-3��$\d��'3��c��a��L�AT<[f@���^})�}�����"�f���v��38Ø�F�A�U�3�9��Ř^_0������+���ퟎ�II��`����ƨ���89�%�l�KKNG��$NN��dջ���$�E��ȕ�r�.-9:	g�89KȻK��m�� qr^�1�=�}�g�D�y��޹���$J�,hWM�Y$LΠ�j�{����	4�U�8�G��sZz!����[�p����81���di�����0H��hV�Q�jN�3���� ����퐎VQ��r�Ѽ���чJ*iΨ34Ӟ	������Mf�W��QT��o`����^�GQq��x�&c��Gq��x~&"�w��ܪ5��$�KH�aZ�a�c��>=�h.s���ic��̕�N�t8���f�^R�\������^+��^e�(re��Z��U�*cF	����kţի�E����^+��^e�(�'�d�Z�h�o���cL�'�������՗"ڟ�>9�iq_+2IM�o�B7f)��gÎ�R����x�OC��y��g���������������R�ƕ\�!W�������xC`����u}w��g��ƕ\�!W���� ���f	����w@��w@+���U�z]ߝ����xC�`
������J�7�������_������F�_���_�����ړaGo�W
Fo��:�[5v�g�*�h�e^C������,��A��fs�o�*�h�%fC��f_�bcF��l����m'�J:�%��%�G�Np�t4���R�\%�k0���M|5��$�������źJy�1�;A�>��Rz�ؿ՜a�����/=A�_9��?`I5^z�0����,)�������i�����a\���wퟰ(��J��!.���,��Ύ�
_�v'X��x�AK:�������d��'}�����;z3D�>Ae�����}��?�h��7��o�{��l?(��;Bw���b}ƔlV��;Bw����}��U>�(�����2㍾��<���-�����<���($c����h�'&���4�
j����`�ic�#tG�r)ӽ����>zT=)�%T���G��'��ȕ5���ѣ
J�.���7�>z���*U�Ȕ�������GR���I���.G�X�tyƘ��]!W)��՗"ڻgua��E���u;��R�,Ő��ѣ�&m]N�����]Z��㩭K�V~i}���}̖��@�~]Z���l���ץ�ѻ<��1W�t��ui}p����>���7�����9�'�0�_Z}��l����~i}?�:��>fi@�]�x(�(� ����_H�	8��[o�|;���:e.��:����t��ǵ�4#���^�}�y�E�J�%I{}s��3=?`�O!��7�K<��z^���۷�:��P���X�Ɍ��Z]��W7փ����[R��l���z0d�R��%պ��W7փ!��:�(W\_�\�[��>�+�t�    ?����h�ߕ���{
i�Տ��]����4��[���}W�颠8~���]�hߕں�|1�K��w��>��yƆ�d�rh1�qF�����'*�A�53T�����J~gC��k����G��6E�5;{��s4 ܮ�������dt����O���v1���`��)��G~i�}� /П\��4 �wfGckO.?e�, �WfGckO�>ET�����'��2S�����'מ�~�3������'���
�1-�#kO�:�՗"�b���\t���v�9��U���3����=y$kcڟe���[�����y����f��~��{��Z��#����Ѿ7O��l������hߛ���s���%�`��)��xCgP{���ɧ����]V�����SBk���4��;�{zJlm`OT�OӬO	�ś:���t9�d}R��t�.�t��[O�|�}R���f#��J�|�}R�c����z���<ݓ:^,2A�6��i�'5�0��l��_���k���B%�K%|?�|�}R�]�1�����k�:^�L!�b_k����X��-��
��PA��(��l�V�<i����4Y��מ鮾�%TGמ��E.�_%TGן��d.կ��+Pbkȕ�.��{U���K�E,�?�5(�5����4kPBk�SH�]��*.��_��3۷Z;z�����JUjn�h���垈�UZl4�K��ĵ�̔5�������'{�~��PC�G_G�\�ɨ�Q�dF���>��SV_�h�<�2��*O�h@�]��o�O.�LҨR�ߎ��>�Γ��1]��Q.��@����w�CT�0:��h����0��Fg�<9���al4��(ϓ�a̔9�N&8�yr<L���J�<9&+0��
b}��h�����:���0�h@�]���<)�Y�!�f������O�I{F�����͜`��EH�F��9�̖������B��N�%�9��u7|���D3W��#W�[���o�,!�,�~�������a�u���@���`
i�EH�{����0�4��[��@<(Z@�Q�wÇ��xZ4����?�I��.��S�X�SO��}�tO�0��Š�9��;��y橧�[���]��y�	a���W�}����y��z�V���>`I�8���޿���P�?:m�d\�+�z?a��o�PZ#k��t|����i�I��_�ҟ/��]s�|b��<�?`>@I��<�$���=�R���o��CZ�O��>�'$j����ar���0;�G�iF?Y�'���	֯<k|8����-dKN���;�N�_X��y���kڛ�����h8�D��3*"�P����'|�������?�;'|`���)0Aej�6n�����ו�����~�o�Ǯe7T�?���qY1m_ޏ]�n�>W��K������}n��рp�n�.e�'(�rL���^�ޏ]�n�>7t�.����~,��X:��/�!���Q+�-���Ņ%ˊ�֯�֚����^ْ�.d�}�Z��(���|�@����P��Z������+)�B��G��؏����e�,!����b=��x��e��cP�k��ؽ��Ky�����z�Na����Ҁvo��)l��\�A���O�;�͕���P�����׌�y���̽�f��y�|���~>f����f����|V�A��pv2zʼf>'��ޭp�1zʰfdi@��tG�?e^3��F�4͕�2��A��p6W�~�/�����ܾ��t���������DX58;�Sm��7�ſ?��_Ύ�T,�M����'�Z��k(�E�\��O���ۯ6X��J$��0"a�cm�𗕬��r|�� ��*Y�)���ݭ(2m,h����-�
��

��h���wv������6H��s�A[��`��!,��GX�]�`����#XR�E�޻z�� �?��+9B W�]=��}��|,!�e	��!�}��|��z��q��'$J�	$>B�}W��u���Y��-�Q��z�Goݿ�_��m���R�nT����jYBe��,�zp�цIz.��Vc�=P��u��ʲ~�4K����n�TQq�3I�~��*Y^})����裭�"G���}��*Y�$�δ��𓭔ɢv1����蓭�\Ӿ8����v�;##,�g$X=�}��7�%���֯G�cC6X\�H����P�zd;6�`���ȕ�3"W�َ�-��8�-r�K8�R��ۋ�:�A-#�4��Ē�`
id�_i> q�%�4��.�����T��r-#�C:6y��=�2޽���p��$�j	֯���U�')�D�,�浌�l�$���GT�&�ݧ(��R�]�'��F/>f}����3�a�G��ѫ3���G�/�G�o�7U�|��~���w
`1��7�?����T����u�x�/KzS��G�կ�ƣW�`Q	%���G�	�',
��:�A�.�#�$�M�>�
|A:zKLyci@��tG�)Q��$���G�)�V��K,ў��c�OH� �q8Ɵ���R?a�y�`�1�`�2��(����-9�#[o��/=>`�`�1�P��&���	J�3W|�b���!�]��ŇS���A�v��f�N��=������$N�!Kڽ�K'|���2��H"��w��n�V���1��!�>�0㕴�=�4����nAC����lG�;Bei6B�k�<֐�~����4��uZ>��vȔ�ِ���c�5�g�ر~�b�޵BGQq�Qa�1�� Gq��W_���+�("��!G���k�y?K1q��A����֚��d�P�Ӿ�k�y?��:0.y��!���Vw60.�`�5��X���;R̖՝y㐃�{�g+���%����q?[1\�8����d,���K���8���VG����VOq�Ux|&��l�p�g^��gb��V
�OqF���k�v?[1��gF�s1�'����td�V<����H���-~|A:�R*�1~�K!����ß���^��B���}�����nz��J��_����e��_ğ����=0���]0�'��ױgj] ��ޓ`�մ��#ۙ�'3[r�l�j�s���ӓ��{���$t���̕�/!W�*�w���"!_鱄����G�3P�u�Z�g�7H|��k0���h|d;��dfi@��t��<=Y@�u,�Z��ߙG(�|1�K�Q��/���6�ٿU������%�����#<��e6���X��ْ#<��6�x��,�YL��O��fϟ� ſB�+��\����?�X�;���cP�]=�(����{
i���n�����,h�����ߙ'((>B0�}W���~�ʷP>B�|�M����v�����˃��������X���mP~���4���a�ز������aY���Z��������H(e�� x�sdƠ���4�SH�/�C:�4�]%��2���j�`��̐W��xW_��3���t��󮎰�lVi6w�ՙ-6f�3�;����Qufs�]��b�a�:���.�%V;փwvY�1��l���L!Uf��}�YЮ��wu�f#�*�y��h6,_I~�?N��f[(���!��	��lVi6���l������!��	��lUg6���\�����f���,!�:f	�k���cP��,��`
�2�E~�#K�u��-�����f���d��U�dW�LF��?�,��,}���YdWG��)~��f�}�`�S����*�:reO��O6���,�<��?٬���:�A5f����k0�T��*�:�4�]'���J���lց�]��g�lV��ϧ�-5����f�Ү.����*�f�]�ؒ�
�Vg6O���4W T��<iW7���rՙ͓vu���,a�c=ig�u�j��I;���Re6O�׍��:�hWWP�\�QUf��ٹ��WA�����@o���>��#,mË�X��Zg����?��#,k�k-Ï����̕u�Ֆ��a��u�P:�j����7���Ta6��ɑ5�Bj�f��=�Ҁv�t|#�����;k`g�~��6�8���������    ���tJ�����l��\5��4�4����S?}�S�͜����8��d�?w�/<���/<us�����.�M�j�:��Ϳ��Rc/�{��u����s��P�Z'��=��%�T�9��/)��V.�|Ƀ�۷Ӎ�"��	��aVi-�]�l�����"��	��aUg/�U�\����"��YB��V��E~��:�A5&s���SH��\�w9�4�]'�ܷ0(>�0��j�;;�aP�
�ը�����jU��|�U��ժ�R��Vg6W��|Bՙ���G�|�3����R�,a�c]-��y6�,{��y6�,w���J��%�R���2����.���fs�]=���;�l,U�YX��X�4��`lufc��t΂����2���3K��sT�nǒ�=������$;{8gAW`�������2��EU���J�9&_��]�k�+`�v��`�T`I��*�S��ם1[��`�T`q����3��ם1W��`�T%��%��۱��Q�a�1L��L!Uf��Rci@�J:̔*(�;T��`���AUf�����v� w���T���"g�U��J�-)rF�:��T���"gBՙfJ�+)rF�:��T�Jȅ�,a�ca�T�a�1L��L!Uf��Rci@�N:�OgP\�̨*��T�����F��%��};�l$U���1�*�FR�̖4�A�:��T)�4��3ɔ2WҘ���FR�"!77a	�KR��cP��H�T�`
�2I�2K�u�IōiUe6�*e�bP��X���'j�o���J�����l0Ujlɛ�ՙ�J�����l0Sj\ɛrՙ�JUB��g	�S��cP��`�T�`
�2L�K�u�ɋ)��7FU��JM�Te6�(=�f�;�l0U*���`�f��RcK�ѐ��l��*Xr�F�*��b�Ը�k4�2�+�JUB��a	�늩R]�1��l��(�5�Bj�抉Rci@�N:�[gP|�ƨ��b���A5fs�D�5�F۾�m6׏T�X��!X��\?r��ؒ��ՙ�G��,����l>��߸��rՙ�G������`	��#_�uƠ��H�~]�)��l>��XЮ�N�H�s6��2����7�bP��|�L��	<��J�a�5��a׋��`�:���)k�����4e��m�0��dMEB���?L�*YSY�1��l$g*k0�T���L���:��n}`������2���5��aWə>��٬��Ʋ�K�`�fcYSd�̆���Ʋ���PufcIS��̆���Ʋ�,�lX(a�cY֔�a�1˙�L!Ufc9Sdi@�N:�������Ʋ�(_�2̙�O�����s�������lVi6�55��������K�lUg6�45��������*!����Վ�YS]�1��l0g�k0�T��L���*�0i���͆QUf�YS�/U��L�(.}޿�n6�5EXf6�K���5e��l�>_%k���l��>_%i�\���/}�J�T$�k~��U���cP��H�T�`
�2ə2K�U�I�T@���/}�J֔�AUf#�K����t����
Vi62��ْd�3�`���@�Puf#�K�+)@�:����"!?2��ݎ%1�cP����RY�)��ldr)�4�]%��.P\ ��*����,_�2˙�'�u�����N6�4̚[r�A�:������������ƕ�l���l0k��c��ڱ0k��0՘�Lu��*�����4�]'���0(>�0��l0kj�Š*�����-yo����f�YS�efC�J��	�Ȗ��ՙ�M0%Xb6��3�_�\�� W����R��7,��ڱl�)��Tc66���`
�2�\�,h�I'�:�b�aT����R�/U��M/����o���eM�k4�U��eM�k4c�3˚��h��2��%M�k4�2��eM�k4��ٱn�5��t6���46���h7˙��hFS'������k��eM�k4�����y=]a����l��Q��`����ln�5U��l���ln�55X`6��3J�*W`6�Ug6�5u	?7,��ڱ(k��0՘�L}��*�����4�]'����lUe6�5U�bP��`��ժ�<Ю�<�l0k*��]�*���Ɩ��!�:��Xg�e�j Ug6�45��]qՙfMUBiy�V;fMuƠ������Re6�35��뤳�0J�� ��l0kj�Š*����g^ ��m6�5X6φ`�f�YScK�� [��`�T`�<Bՙ&M�+�g�\uf�YS��g���Վ�YS]�1��l0g�k0�T��L���:�dB��y6��2̚�|1��l,gz�{�m�N7�iJ����|����Ȗu}�o66ה`Y���fcSM�+��<�ll�)K(��盍�5�u�j��f��L!Ufc�L���:��z�MPUfcSMQ�Te6�3�>8��������tӡ��7xd<����C�ӯ�}e�3!ʠ~�F�]gF�D���W�:S�L�wi?7���V;eS���!p�IQ>����V��T��6�i%)%V���4���*���WY��U&�����^����t�������*M3������ά0�*���$�:���qE'&�3'̰���[%�v0:�:�A5f��U]�)�ʄ0�j,hWI�	V'&EU�fXM�Te6�_]����f�V�e@�@��K����ll^jZx �:��i�q�qՙ�MK�T�nǒy�aၮ���Jt6�dNjZx`4U�٤Ը�@QUfc�R�����Du���r����N7ʰ,,�X��P�U٢�jc�3ʰ,*�T��P�U���j�3ʰ��P��V;eX}Ơ������Re6�_U��뤣jx%Պ�2ʰ�|1��ldV����l�o����JEX�s�`�f�VcKz�![��`�U`I�5Bՙ&X�+鹆\Ufs��J�}�X�fǺc�U�a�0�;�Wu����c~�XЮ�N�C2(�ƨ��c���A5fs���v���o6����掳R�]���l�2/�ْk4d�2���KEXr�F�*��˴T�J�ѐ��ldZ�H�W1,a�cɼTY�1��ldV���Re62'�YЮ�N��_�1��ldZ*�����#����u:�r���-���z��|�X�B�����J��Ȳ~g���|g�3��<�Wh?��+��|.?w������u��k���?����Y�d��߬�`�}d[�6sX�}�[��5�c'�ϝ�7��!d�)}d]�K9 �2&ɺn[o,}mӳM�©(�%�R�U��]�-�2[�I�aq�QuF$iW抃��UgB�w	1�(V;��]eƠ󑬫��Re<�ue���㴫��`���G�,_�2̺�N�G:-t�v��`�U`Y�4�*��Ɩ�I#[��`�U`I�4���Ӯƕ�I#W��`�U%�R[��ڱ0��0՘f]u��*�����4�]'�T�3(.�fT��`���AUf�Y��?��l�o���UXj6�O68[��2����٪��f��'�Wf6�O68YU%�k��g��:�A5f�sUu��*�����Ҁv�t���'EU�NV5�bP���\��l�o����U��F`�f��TcK�����\���f���S�ƕ4�f��T��J���\���Tc6�I�5�B��3��Ҁv�t�JUP����RM�Te6�I}5�K+��o���R�6�_�&�U�-k:�rMf�",k:�rM&�2W�t~�LV	�����5��*�0՘��U�5�B��Ff�2K�U��TU%�@�W��dU�/U��dR���f�v���\U�e�@	Vi68[�ؒf��Vg68[U`I3PBՙNV5��(rՙNVU	��$K��X�Q��a�1���k0�T��T5����é�
���2��lp�������^N�[z��;�l,�J�, J�J��\*�%Pd�3˥,	���l,��\I ����r�,!�Y�f�zX.��a�0��eRy���yX&YЮ�NR�����1���RQ�Tc6̤�N��,��f��\����ՙ�s�Ɩ [��<0�*��@�PUf��T�q%�Ue6̥�����V;�RuƠ��L���Re6�I5��뤓J    ���2̥�|1��l0�z>�O���W[��fCsU��lVi62[�ْ��ՙ��VEX��!T���dU�Jr6�Ug6�$����`	�Kf��:�A5f#sUe��*�����Ҁv�t�GbP��aT���dU�/U���U�<�j���l����˪�Vi6��A�����F��K��Ug6�4e�����F��"!W4��Վ%YSY�1��l$g*k0�T���L���:餾�Aq5���F��,_�2əޮfs�o62Wa����l0kjl�� [��`�T`����l0ij\�� W��`�T%��%�v,̚�:�A5f�9S]�)��l0gj,h�I'�:�b�aT��`���AUfC9��z������N7ʚ,G �J�����E����l(kj�h���̆����#0�:����K-�U�jǢ����Tc6�3�5�B�̆r��Ҁv�t4wCA�8EU�eMU�Te6�3�����1$����J�珢~`��ؒ���#��5XR�<}����ƕ�>�9����J���GM?0k��0՘�Lu��*�����4�]'�T�3(.}�?J��YS�/U��L/��%���o��fM��>��ld*�%���Vg62aI�3���F&�2WR��\uf#PEB.�e	�Kf��:�A5f#�Oe��*��٧�Ҁv�t2�T@q�3���F&��|1��l0g�ꋓvؿ�n6�5X�m�5fM�-�6����z�M�Fä�qe���_�a�T%��Z��0k��0՘�Lu��*�����4�]%&M��F���YS�/U��Lϧ[�f��v��`�T`Y��x�����%����K
��`�Ը��?�f�YS������fMuƠ
�Y0g�k0�Ԙ͂9Sci@�F���
���,�55�bP��,�3}ͪ�-a����l�Y(kj��@@`uf�P�T٢c�2�����
Ue6%M�+*0�*�Y(k���{��ڱ(k��0՘�L}��*�����4�]'U�(((PT��P�T�AUf�9ӿ=g�H��o��,�5��s6�dM�֜�"Iӿ9g�H��o��,��T�����"9ӿ1g�H��o��,�4��s6�dM�Ɯ͂9��i��,��f�YS�e�4̚[R �lufs�wS�%��3L�WR �\uf�YS���Y�j�¬���Tc6�3�5�B��s��Ҁv�tR	à�@�QUf�YS�/U��L_}q��-�K�̚
,�6��y���Ȗ�F�^���\S�e��f�>/6����h�K��j�J��ϋ�5�u�j��f��L!Ufc�L���:鬏���4FU��M5E�bP��H��~�l��N7�i*��7�*��[�����
,�F�:����ƕ�FC�:����*�̱��f�sMuƠ�����SH���<Sci@�N:��Ƞ�7������|1��lp����l��9�E��K��Vi6�5e������F�����Ug6�4e������F��"!^ň�Վ%YSY�1��l$g*k0�T���L���:��n]@�5����F��,_�2�iz(��/����
Vi62הْd�3�k���@�Puf#SM�+)@�:����"!?2��Վ%sMeƠ�����SH���<Sfi@�N:��aP\ ��*����,_�2���������y��֤D�߾�n8yӯ�>,�+��t>2��Y�i;�Y��#w��O����3����w�~��w�:�ȟ�F���o�v���o�� �ƈ>2��Y�9�ʌ>r���ұ��#��`��ʔ>2�ߥ VfR7|��;۷�M�r��NA�4$˥"[r
B�:3�\*��S���R�ȕ����΄,���/i��۹��=��Tc>�I�5�Bj�g�L*�4�]#�j�Tŧ F��j�T�/՘�j��[>hm�v�٬8�T`����lV��jl�� [�٬8U`����lV��j\�� W�٬8U%��%�v,��yƠ
�Yq����Re68��XЮ���*(6FU�N@5�bP��������L�w�o���R�u�&X��`.�ؒ��Vg6�KX�!�Puf��T�J:D#W��`.U%�.�,a�ca.U�a�1��ti�5�B��3��Ҁv�tҟ�Aq�hFU��RM�Te6�I}�c��k����s�K39�+�V̥[�ə^��b.U`Y&gv��z��RZ�f\uf��T�Pr�+�V̥�:�A5f��T]�)��l0�j,h�Ig٥�rMQUf��T�/U��eR�>j�o���R�u��Gm�\��%���Q[1�*�����>j+�R�+�60��ڊ�T��������K�u�j�3��SH��`&�XЮ�N��}�Ue6�K5�bP��`&�U�}��ܧ��R�fr Vi6�K5�,�Cluf��T�e�@ՙ�R�+��W��`.U%�\JX�X�K�u�j�3��SH��`&�XЮ�βKJ29��2̥�|1��l0���ښ��l�N7ɥ",;���l$��l�����Fr�KN6��3I�2Wr�A�:��\�Hȿ�Y�jǒ\���Tc6�I�5�B��F2��Ҁv�trà�dè*��\*����3����4P�v�_�f�T�e�h�4˥"[R��lufc�T�%�h��3K�"WR��\ufc�T��+�X�jǲ\*��Tc6�I�5�B���2��Ҁv�tR�Ƞ��QUfc�T�/U���?},k^���=�ld�)²j4�U��@5�����g�
,�F#T���T�J�ѐ��lp�J�M,a�c�T]�1��lp����Re68��XЮ�N�W�1��lp����̆柾��\B�y;�l(kj�l��*͆��ʖZC�:������Ak��3J�*W2h��̆��.!�b	�����cP��P���`
�2ʙ*K�5�=)i�x��j��IYS�/՘͓r���z���z�m6Oʚ,3�ՙ��f�"[b6�Ve6O��J��lUe6O���\�� W��<m*K�K��X���:�Af����SH��<m�)�4�]%�M?ePl6��2����Š*�����t���o�o���dM���l$k�lI� �ՙ�dM���l$i�\I� rՙ�dMEB~df	�K*bxƠ������Re6��A���������FU��dMY�Te6�3��9����f�YS�eo6�4���lɛ�ՙ��@EX�fC�:��	�̕�� W��\䆝%�{��ڱd���Tc62�T�`
�2�}�,h�I'/���lUe62��AUf#�O�Kn6��t���)�2�!X��H֔��A�:���)��!T��HҔ��A�:����H�KX�X�5�u�j�Fr��SH��HΔYЮ�Nvu�fè*���)���̆r����S�|;�l(kj��͆`�fCYSeK�l���l(kj��͆PufCIS�J�l���l(k��?KX�X�5�u�j̆r��SH��P�TYЮ�N^L��0��l(k��Š*����k��-u���n6�55Xh6�4ʚ*[d6�Vg6�55Xd6��3J�*Wd6ƕ�����ٿ`Ѯ��ڎ����]�aJ�&�D;�����M��uci@�N:�����2��`��`6&_In`�y6��#f���;�x���r��`a��ؒk��y6,��I��*5������l���l0k��U��<���ń�lt6��&�g�+��$���<���N���y6��2̚�|1��l$gz?��Ӷo����?EX�A a�f�YSc�;0[��`�T`qDՙ&M�+� �\uf�YS�S�"a�ca�T�a�1̙�L!Uf�9Sci@�N:�  ���������&_�2ʙ���na�����fcYS�eo6�4˚"[�f�lufcYS�%o6��3K�"W�f�\ufcYS����Y�jǲ�)��Tc6�3�5�B���r��Ҁv�t�bʠ�͆Qf�8Y��Af�A���y�����f�����y�g�U��˺��]����l6X�y=������@Y����3s՘��:��]�E�b��`�L��볬����H�>�
l �,���3�TI�M��*�`��2b`�@ �d���o��fM�O� ���9Iae�3̚
,�6�A e����Ug6�5U	e �P��Ϳ�:�*l ��������    �L���*�.6�.� �*���������f�>�۷��Ʋ�Kf_�m���4� �lufcYS�e���6P�n�w`�:���)K(�̳��6XV�v�UX@�Z5L�A@V`�*a�LS%�%M�̿F��)����s���������t�������U�fM�-.`�:������Dՙ&M�+.`�:����J���"a�ca�T�a�1̙�L!Uf�9Sci@�N:��PX  �*��������Fr��)�Fۿ�n62�a٤N�U���5E�dR'�ՙ��5%X2��PufcSM�+�ԉ\ufcSMYB���V;��5�u�j��f��L!Ufc�L���:�d�)��I���2�j��Š*������@���P�������!X���\Sfˮц��d��&oWC�:����̕]����`�M�@���ڱd����Tc62�T�`
�2�g�,h�Igw��jUe62Ք�AUf�9��ty��j�o��eM�>��l(k�lQ鳱ՙeM�>��l(i�\Q�qՙeM]B(�U	�����cP��P���`
�2ʙ*K�u�Qպ���gEU�eMU�Te66���N�ܿ�n66Ӕ`�Xh�U��dM�-�luf#YS�%c�	Ug6�4e�d,4rՙ�dMEB-�V;�dMeƠ������Re6�3e��뤓Y���B3��l$k��Š*������F{;�lp�������h,{3{�)[��P��`Y��Ho������є��l(k��#���h,���z��*l Y5L��W`�*a��hJS'�U��Ue6�5U�bP�ٜ)g�
�\R�ٿ�m6g˚,u��lΖ5E�$ԉlUfs��)��P'����lIS�JB��Ue6g˚��d	��lYS^�1��lΖ3�5�Bj��l9Sdi@�N:I�2(u2��lΖ5E�bP��H�t;�����hg̚
,+ X���\SfK
���ld�)Bՙ�L5e��@ ���F�������V;��5�u�j�Ff��L!Uf#�L���*�d����FU��e`g����$����l�o����4%Xv�!X��Hْ֔��ՙ�dM��lUg6�4e��d�\uf#YS����ݎ%��yƠ������Re6W���,hWI'IS�'FU��dMY�Te6�3��ln���f�,��9�lt�������F��'Bՙ�N58� W���TӁ�K��X6�4>��*, �L��d�+��d�L��TI�MN6��2�j�lP�
�LH��]��o��eM�O#X���\ScK��![���\S�%��Ug68�Ը��i�Ug68�T%�\,a�c�\S]�1��lp����Re68��XЮ�N��1(�ƨ*����&_�2̙����v5۷����KK��fM�-+}�o6�5XV�<�l0ij\Y��|����J(������cP��`�T�`
�2̙K�u�Y�zޮFPUf�YS�/U���L��[�fs�M7ʚ,{�!X���\SfK�l���ld�)7Bՙ�L5e������F����|��V;��5�u�j�Ff��L!Uf#�L���:��ŔA����F���|1��lp���j�)?�l��l���)����*�Ʋ�Ȗ�l���l,kJ��dC�:���)r%'�3˚����%�v,˚�:�A5fc9S^�)��l,g�,h�I'�0�O6��2˚�|1��l0gz9=�s^ �m+�����
Vi6�55��@ �����K
Ug6�45��@ �����*!?2��Վ�YS]�1��l0g�k0�T��L���:��Aq� �����&_�2̙nG������l��X�4�  �:��X�4� `lUfs��i�A@PUfs��i�A�����bYӸ��J��X˚�t6��&� �+��$��i���N�����1��eM�&_	s���v}޿�n6�5Xv�F�J�����%�h�Vg6�5Xr�F�:����q%�h�Ug6�5U	�*�%�v,̚�:�A5f�9S]�)��l0gj,h�I'w����Ue6�55�bP��\,�4P �N/�h�t�@�`�f�YӁd�3͚���3M� W��h�t�@�%�v,͚��
H�3�x6�,g� M�tWK�0��l4k�|$��4�m���"YS�e����F�Hْ֔�i�{�]$k��dx���hI�2W2<m~o��dMEB�5�7�E���cP��H�T�`
�2ə2K�U�I�T@�����.�5e�bP��X���V���N7�i*��@�`�f#sM�-)@�:����K
Ug62Ք���3�j*�#3K��XR��0՘��4�5�B��F�2K�U��DS���2�j��Š*�љ���l��t�љ��� ��ld�)�ec�盍�5EX6z���TS���B�7�j*�h��f#sMeƠ�����SH���<Sfi@�N:�U������F���|1��ld��Oۿ�n6�5EXf6�]$k�l����v��)���><�"IS�J�f��dMEBް�O�H�T�a�1ə�L!Uf#9Sfi@�N:����i��2ɚ�|1��l0gz>�O׸m�v��H�aI5�*�F���W�1[��H�aq5���F���W�1W��H�T$Ċ&��ڱ$k*�0՘��Le��*���)�4�]'�7
(�FT��H֔�AUf�9��*�F۾�n6�5EXz�6�M��̖]�ͯF��)²k���h�4e��m~5�dMEB���_�&YSY�1��l$g*k0�T���L���:��n=�FT��H֔�AUf#9����2�l$k���l Vg6Wɚ2[f6�Ve6Wɚ",3@U��U��̕�qU��U��"�lX(a�c]%k*�0U��Ur��SH��\%g�,h�Ig�:��AT��\%k��Š��J��q�K��og��Uf�",�F#X���\SdK�ѐ��ll�)��j4Bՙ�M5E�����Ʀ���\��V;��5�u�j��f��L!Ufc�L���:餾�Aq5���Ʀ��|1��l(gz^O��]����fs�Y����l(k�l�<c�3ʚ,�g#�:����rE�l���l(k��L��ڱ(k��0՘�L}��*�����4�]'MHRP0�FQUfs��a���WA�	Iװ���t�������i�4ʚ*[2<��̆��K����l(i�\��4�3ʚ��<��%�v,ʚ�:�A5fC9S_�)��l(g�,hWIGIS���Ue6�5U�bP��P���jk����t��������*��[r�A�:����KN6��3�jj\�����������%�v,����0՘�4�5�B���K�U��DS�'FU�N55�bP��H��~��o���dM��F#X��Hْ֔�h�Vg6�5EX��Puf#IS�Jz�!W��H�T$��Z,a�cI�/^�1��l$g*k0�T���L���*�$i*��7���F��,_�2ə>�i�����f#YS�e�4ɚ2[R �luf#YS�%��3I�2WR �\uf#YS���Y�jǒ����Tc6�3�5�B��Fr��Ҁv�tR	à�@�QUf#YS�/U��L_�u�{�fs�O7ʚ,{�!X��P�Tْ7d�3ʚ,y�!T��P�T��7�3ʚ��|��V;eM}Ơ������Re6�3U��뤓S�o6��2ʚ�|1��l0g�jU��l�o���eM	�������)�e�j�l,kJ��]����%M�+kW3�dcYS�PZ��?�X֔�a�1˙�L!Ufc9Sdi@�N:���lUe6�5E�bP���L��@��6���f�,�F#X��Hْ֔k4d�2��dM�\���ln�4e������&YS���bX�fǺI�T�a�0���Le����IΔYЮ�N��_�1��ln�5e�bP���l�����֓��f3M	�OX���$k�l��4b�3ɚ",��:���)se�ӈ��l$k*� .��ڱ$k*�0՘��Le��*���)�4�]'�ͽCP2<QUf#YS�/U���L�Sn6۷��g�
,mW3�l.�&7f�3�k���]�t����̕���o62�T$��'��F��:�A5f#3Me��*��y��Ҁv�t�&7AU��L5e�bP��\mBR>b`�v���LS��    �Ӧ�:o2הٲ�i�C�7�k��lx��P�M��2W6<mz��&SMEB�5=�y����cP���LSY�)��ld�)�4�]'�ͽ�G��ld�)����g��O�{j6����g�
,1��J������`�:�����G ��lp��q�#���lp��J�m�E�j�¹��cP���LS]�)��lp���4�]%N4UP8b@PUf�SMM�Te62�����7��<�l,kJ��͆`�fcYSdK�l���l,kJ��͆PufcIS�J�l���l,k��?K��Xr���0՘��Ly��*���)�4�]%�%M��0��l,k��Š*����kpNZ��;�l0k*�tx����fM�-�6����YS�e��f�>�0ij\����7̚��2�kz�����cP��`�T�`
�2̙K�U�a�TA����7̚�|1��l0g����k����f�3M����k4�k�_�1[���\��Quf�SM�k4�3�j�_���Վ�sM�k4Y�$���k4Y�$���k4����v��MPUf�SM�k4���$7�q�s�v���LS�eo6�C�7̚[�f3?�yì���7���&M�+y���a�T%�{����fMuƠ������Re6�35��뤓�8ԩ�*��������Fr���@o��|���)��j��fcYSd˪�曍eM	�U��6��%M�+�F�n6w˚��R�4�l�5�u�*��n9S^�)��l�3E��뤳�Ɓ�h��1��eMQ�Tc6w˙>����l��K�a��L���m�)�ef3=gs�����fv��nSM�+3��9��M5e	eÚ����\S^�1��ll�)��Re66�YЮ��v�<g#�*����(_�2ə.�k�\���eM	��:	Vi6�5E�$ԉlufs��)��P'���ƒ�ȕ�:���l,k�r0�%�v,˚�:�A5fc9S^�)��l,g�,h�I'ISšNFU��eMQ�Te6�3}�a�������*��	��lVi6�5E��d�lufcYS�%'Bՙ�%M�+9� W��X֔%�_�,a�cY֔�a�1˙�L!Ufc9Sdi@�N:��aP|�aT��X��AUf#9��<Ю�<���K�>ϿFì��e]��_�a�T`Y����h�45�����k4̚���9x�5fMuƠ������Re6�35��뤳���jUe6�55�bP��`������6�l$k���l Vi6�5e��l���l$k���l Ug6�4e��l���l$k*ʆ�V;�dMeƠ������Re6�3e���������AT��H֔�AUf�9�|����t����K;L1p���̖u�>b�.sM�u�=b�.SM�+� 0}��]�����B�>b�.sMeƠ�����SH���<Sfi@�J:�h*�����w�j��Š*�љ�y�����f�3M�v5�4̚[6zz��;fM����ݮ�IS���BOoWsǬ�J(������c�T�a�1̙�L!Uf�9Sci@�J:L�*(=�]���&_�2̙n�6`6�?`6�5Xv��f#sM�-9������KN6��F��2Wr��f#SMEB�u��F��:�A5f#3Me��*��y��Ҁv�tr3`6��2�j��Š*�����e g��/��)����*�Ʋ�Ȗ�l���l,kJ��dC�:���)r%'�2��eMYB�u�6;�ò��cP��<,g�k0�Ԙ��r��Ҁv�trà�dè�yX��A5f���>�fs��f�)²�����asM�-9� [��<l�)�������aSM�+9� W���TS����ՎesMyƠ�����SH���<Sdi@�N:��aP|�aT���TS�/U���L������t���i��Y`�f�sM�v5�Vg6:�4nW��:���TӼ]sՙ�N5��Ո�Վ�sM�v5�
H6�4mW#+��d�L�v5LS'�M4�����lt�iڮ�� ��m�@�6���aYS�e�h�4���� [r��lufcYS�%�h��3K�"Wr��\ufcYS���bX�jǲ�)��Tc6�3�5�B���r��Ҁv�tr�Π��QUfcYS�/U��L������y;�l(kj��lVi6�5U��l���l(kj��lUg6�4U��l���l(k�~nX.a�cQ���a�1ʙ�L!UfC9Sei@�N:��ԧ�8��l(k��Š*����u�d3�@�!YS��'��ɚ2[v��^ �)²�����$M�+;��/���H(���H�T�a�1ə�L!Uf#9Sfi@�N:��(`T��H֔�AUf#9��20b`��f#YS���h��l$k�lY5��7ɚ",�F��f#IS�ʪ���H�T$����o6�5�u�j�Fr��SH��HΔYЮ�N��J����H֔�AUf#9��i���L7˚,3�U��eM�-1d�3˚,1Bՙ�%M�+1�3˚���a��ݎ%;;��Tc6�3�5�B���r��Ҁv�t�4ePl6��2˚�|1��l$g��������f#YS���h�K�%k�lY5���gɚ",�F�^�,IS�ʪ��>K�T$�����ϒ5�u�j�Fr��SH��HΔYЮ�N��J���>K֔�AUfC9����=1��v��P��`Y� �*͆��ʖ [��P��`I� ��̆��ʕ W��P��%�Gf��ٱʚ�:�Af�P���`
�1��r��Ҁv�tR	à�@�Q5f�P�T�A5f��LӁ������Eg��>��l�k:P��lUf��\Ӽ��PUf��TӁ�g�2�E���>��Վ�sM��g^�$�i�>�
l �<Ӽ�iꤳ���ό�2�j�>�|$��ϧ�5��;�l0k*��lVi6�55��l���l0k*��lUg6�45��l���l.�����a��Վ�YS]�1��l0g�k0�T��L���:�hWWP`6��2̚�|1��l$gz��:_�cg��dM���!X��Hْ֔v5�Vg6W�C��]���F��̕��A�:����H�-OX�jǒ����Tc6�3�5�B��Fr��Ҁv�t��Aq�FU��dMY�Te6�3��l.�s6��4%Xv�F�J����̖\�![���\S�%�h��3�j�\�5rՙ�L5	�*�%�v,�k*�0՘��4�5�B��F�2K�u���:��k4FU��L5e�bP���L��37�W��f#YS�e'�U��dM�-9� [��H�a�ɆPuf#IS�JN6�Ug6�5	��1KX�X�5�u�j�Fr��SH��HΔYЮ�Nna�lUe6�5e�bP��X�t����4�l,kJ��dC�J���)�%'d�3˚,9���l,i�\�����Ʋ�,!�:f	�˲��cP��XΔ�`
�2˙"K�u��-�����Ʋ�(_�2˙^�ͫ��l���)��k��9�Ų�Ȗ]�M��,�5%Xv�6;g�X���k��9�Ų�,�\�L��,�5�u�j��r��SH��X�YЮ�Β�J�Ѧ�l˚�|1��l0gz>�n����N7̚
,�F#X��`��ؒj4d�3̚
,�F#T��`�Ը�j4�3̚��\��v;��9�:�A5f�9S]�)��l0gj,hWI�IS��h��2̚�|1��ll��s��9��f�,}��_�&sM�-{��_�&sM���L�F���̕��̯F���"���ϯF����cP�٬�3�5�Bj�f�y��Ҁv�t�L4P�f3�m���,_�1��f����og��jYS�e�h�3�ղ�Ȗ\�![�٬�5%Xr�F�*�Y-i�\�5rU��jYS���bX�jǲ�)��Tc6�3�5�B���r��Ҁv�tr�Π��QUfcYS�/U���4����N�F[m�)����*�F�2[r�A�:����KN6��3�j�\�����F������%�v���f�u�j�Ff��L!Uf#�L���:���A�ɆQUf#SMY�Te62����'��m��H�a�Ɇ`�fcsM�-9� [���\S�%'Bՙ�U~�#Wr�A�:����,!�:f	����:�A5fc3My��*��y��Ҁv�trà�dè*����(_�2̙�Oۂ�^[�l�������U�fM�-.`�:������Dՙ&M�+.`�:����J���"a�ca�T�a�1̙�L!Uf�9Sci@�N:��P    X  �*��������Fr��9/x�|�m6�5EX6b�`�f#YSfKF [��H�aɈBՙ�$M�+1�\uf#YS���Գ�Վ%YSY�1��l$g*k0�T���L���:�d�����2ɚ�|1��ll��c g��fcYS���h��l,k�l�5��7˚,�F��fcIS�ʮ���X֔%����o6�5�u�j��r��SH��X�YЮ����r6��2˚�|1��l(gz^O�G8b���t������y6�4ʚ*[4����̆�������l(i�\�<�3ʚ��0E%�v,ʚ�:�A5fC9S_�)��l(g�,h�IG�̳QT��P�T�AUfC9��
��N7ʚ,5���5U��l�P��`��L/���ref3�@���.�lX�(k��0՘�L}��*�����4�]%%M����ʚ�|1��l,g��l��N7̚
,� �N6�55����8�`�T`I��'L�W�A��l0k�r
��l0k��0՘�Lu���yb��XЮ��IS��l��55�bP��<%g������e�m6O˚,��:�yZ�ٲ�h�Ve6O˚,��*�yZ����h�Ue6O˚���_%�v,����0U���r��SH��X�YЮ�Β�Jz�!��l,k��Š*����k�tj6�o��eM^�	��l(k�l�5��ՙeM]�	��l(i�\�5�qՙeM]B�c�̆���cP��\�F�`
�2ʙ*K�u��ݺ��k4EU�eMU�Te6�3}�C�X����͆����f�X�'eM�-1��c���55Xb6��B?)i�\�����ʮ���v	�����cP��P���`
�2ʙ*K�u�ɮ���vT��P�T�AUf�9����7���t���)²7�U��dM�-y�A�:���)7Bՙ�$M�+y�A�:����H(s��F{J�T�a�1ə�L!Uf#9Sfi@�N:y1eP�fè*���)����Fr���e�l.����K�`�f�YSc�̆�������Puf�IS��̆�����*�lX(a�ca�T�a�1̙�L!Uf�9Sci@�N:���������&_�2�i�1��f3M	�5�$X��Hْ֔F��Vg6�5EX҈�Puf#IS�Jq"W��H�T$�f�,a�cI�T�a�1ə�L!Uf#9Sfi@�N:��ˠ�'���F��,_�2̙n���Ѷo���4Xv�!X���\ScKN6�Vg68�T`�ɆPuf�SM�+9� W���TS����Վ�sMuƠ�����SH���<Sci@�N:��aP|�aT���TS�/U��4}�r6��9�'�4Xz�6=g󴹦Ȗ]�M��<m�)��k��9��M5E��mz��iSMYB�����y�\S^�1��ll�)��Re66�YЮ����r6��2�j��Š*�������40<�4�@ ���r6�4�k�lI����F�",����ld�)s%9�3�j*rV�%�v,�k*�0՘��4�5�B��F�2K����� (��0��l6X;;�lP�
��V_N6�d�����[`��`Uf���_�Ė�l���l6X�k`��P5f�����ĕ�l���l6X�{%�_�(a�c�ov\�1��f�A�_�SH��,'̙K�U�a�TA��QUf�YS�/U���L���C�,y/� ��J�������ll�i�A QufcSM:0W���TӁ"a�cIEL�A@Va�f��d6��&� �4U��DӁ��2�jw`�*H��?�I�۷���f�,3�U���5e��l���ld�)��!T���TS�J����F�����a��Վu����a�1�i*k0�T���3e��뤓]�A��0��ld�)����s���i����fCYS��Vi6�5U�����ՙeMuT��P�T���Ug6�5u	!��V;eM}Ơ������Re6�3U��뤣

:(��l(k��Š*����崜&u��fM�M�$X���\SdK&u"[���\S�%�:	Ug66���I��Ug66Ք%�i�,a�c�\S^�1��ll�)��Re66�YЮ�N&�2(��ɨ*����(_�2�iz_�l��o6�5%Xv�F�J���)�%�h�Vg6�5%Xr�F�:���)r%�h�Ug6�5e	�*�%�v,˚�:�A5fc9S^�)��l,g�,h�I'w����Ue6�5E�bP���L���X����,�qM�J�����e�ϳ�Bo���1M�:����qe�ϳ�Bo��z}`,4KX�X�5�u�j�s��SH��`��XЮ�Ϊ��B3��l0kj�Š*�������P���t�����2�!X��`����A�:������!T��`�Ը�A�:����J�KX�X�5�u�j�s��SH��`��XЮ�Nvu�fè*���������r�q����t��������(}���q鳱ՙ��5MK�Ug66�4.}6�:����q�JX�X6�4,}�U�@�DRX��+��$i����hꤓ<R\����9c���A5fs�����_�m��6�3fM�����l�2הْ7d�2���5EX�fC�*�9�TS�J�l���l�2�T$�{��ٱ�2�T�a�0���4�5�Bj��,�L���*�d����7FU��L5e�bP���L�M׼�<��K*a�U���l$k�lI5�ՙ�dM�T���l$i�\I5rՙ�dMEB�hb	�K�yƠ������Re6�3e�����H}#��j4FU��dMY�Te6�3�~*?�>?�fM�]���l0kjl�5�ՙfM�\���l0ij\�5rՙfMUB��a	�K�bxƠ���=��Re6�35����ä���k4FU�fMM�Te6�3].y����t��������*��[r�A�:����KN6��3�jj\�����������%�v,�k��0՘�4�5�B���K�u��-��������|1��lp����X�v5۷��F��˪�Vi6�5e�����F��K��Ug6�4e�����F��"!W4��Վ%YSY�1��l$g*k0�T���L���:餾�Aq5���F��,_�2ə>�Ϗ�'ɚ",3�U��dM�-1d�3ɚ",1Bՙ�$M�+1�3ɚ���a��Վ%YSY�1��l$g*k0�T���L���:�dWgPl6��2ɚ�|1��l$g����s�.8���dW'Xf6�4˚"[b6�Vg6�5%Xb6��3K�"Wb6�Ug6�5e	y�b	�˲��cP��XΔ�`
�2˙"K�u�ɮΠ�lUe6�5E�bP��X�4�;�l,k��X��X�4mlufcY�t,����ƒ��Xh�3˚�c�U�jǲ�i8ZWa��a�j4Y�$�]��ј�N:�[ϫ�Ue6�5�B�|$K$�9����f�Y�4g#�J�Ѭi��1�:�Ѭi��T��h�4��W��h�4�٨�Վ�Y�,g����d9�,g�+��d9�0gc4u�Y�4��(��l4k��lL��s�����B�g���`�ou�e'�ՙ�E��̖�l���l.�5EXr�!T��\$i�\������"YS����͎u�����Ta6ə�L!5fs��)�4�]'���0(>�0��l.�5e�bP���L��3-ؿ�n62�a��a�f�YSc�O6�Vg6�5X|�AT��`�Ը�sՙfMUB�u,V;fMuƠ������Re6�35����ä�������2���Ɇ� �o�[>�f�v���LS�e'�U���5e��d�luf#sM��lUg62Ք���rՙ�L5	��1K��X��a�1�i*k0�T��U~�#K�U��DS�'FU��L5e�bP���L�tR����fc3M�I��4ɚ2[�m��΋dM��F�>��"IS�Jz�͟�y���H����O�H�T�a�1ə�L!Uf#9Sfi@�J:I�
(�6R�E��,_�2ə>�����P�Ų�KGLu^,k�lو��΋eM	����X����C�˚��Ҧ~z��bYS^�1��l,g�k0�T���L���:�l��@��QUfcYS�/U��Lϧے��l�N7̚
,�F#X��`��ؒj4d�3�    �
,�F#T��`�Ը�j4�3̚��\��V;fMuƠ������Re6�35��뤓�F��h��2̚�|1��l(gz�^��׮V�����C��o��x��+͇��_���^gB�A����Ό(���;0���u�D����~nnߥ�v8ʦ~_�C���|��5;�2+ʩ~emP�NRp���>��;�ʼ(��U�!p��a~usˁ*���r������r���%'�?P�V�%'��Un�`5������0ê��?P�V]�1�ƌ0��k0�T��W���:��vg��MPU��V�/U���W�����fc�R��9�U�fX�-y��s�aX�4�z�ƕ����9̰�������0ê�0՘�Wu��*�����4�]'�����s��2̰�|1��l0��zt�v��s�jV����{�]-ÊlY����kW˰,+<��s�j	V��
��\�Z��%����=׮�a�u�*��j�U^�)��l��_E��뤳
���k��1��eXQ�Tc6W���X���2�llV*���j�U���Ke������F�",)�&T��ȴT�JJ����ldZ�H�e�,a�cɼTY�1��ldV���Re62'�YЮ�N���T3��ldZ*�����b�!N6����eX	�6����+�e>�l,�J�������%X�+k�9�dcV�P�D�?�X���a�1˯�L!Ufc�Udi@�J��u�8�0��l,Ê�Š*�����9p���n6�aEXz��J��+�e�h�Vg6�aEXv��:��+se�h�Ug6�a	�*%�v,���u�j�F�SH��H~�YЮ�N�J��Ue6�ae�bP��`~�|��������3�˪�Vi6�a5�����3�K��Ug6�`5�����3�*!W4��ݎ%u��cP��`~U�`
�2̯K�U�a�UAq5���3�&_�2˯.�����t��Y�K����ؼTd˪���ؼT�e�h��llZ*re�h��llZ*K(M��ll^*��Tc66+��`
�2���,h�Ig��������Ʀ��|1��l,����Y��ɹ�T�e'�U��K5��d�luf��R��lUg68-ո��rՙNKU	��1KX�X8/U�a�1���k0�T��I5��뤓[�'FU�NK5�bP�����z��c��X֔`����l,k�l�� [��X֔`����l,i�\�� W��X֔%��%�v,˚�:�A5fc9S^�)��l,g�,h�I'�:�b�aT��X��AUfc�Ro>o�|^-kJ�tt���W˚"[6�`z�ϫeM	��.����jIS��FLo�y��)K(��7��Z֔�a�1˙�L!Ufc9Sdi@�N:��1���QUfcYS�/U���J���h�����f�,;���ln�55��d�lUfsì��������IS�JN6�Ue67̚����%lv�fMuƠ
��a�T�`
�1��L���:���A�ɆQ5fsì���j��f9�e�d�L?��lV*����'��dM�-+�~��I�aY����M��̕L?��$k*�#����M���cP��H�T�`
�2ə2K�u�Y%��ɆQUf#YS�/U���L�@5�:��v�D�@5�*�F���h�Vg6�5ͫ�Ug6�4�FC�:�Ѭ�@5KX�X�5���x6�,gW��
l Y�4�FC�:�,i:P�ƨ*�����\�v����-x;�l,kJ��d3}T�Ͳ�Ȗ�l��(�Y֔`��f�h��%M�+;�LIp��)K(����"�Y֔�a�1˙�L!Ufc9Sdi@�J:K�2(9�L5p��)����s���uI����N7̚
,4�U�fM�-2c�3̚
,2Aՙ&M�+2�3̚���a��ݎE;���Tc6�3�5�B��s��Ҁv�t�4UP`6��2̚�|1��l0g���Nfs�n6�5Xj6 �4̚[f6�Vg6�5Xf6��3L�Wf6�Ug6�5U	e�B	��vv\�1��l0g�k0�T��L���*�0i���lUe6�55�bP��H��~K�f�v��`�T`Y�g�U�fM�-���luf�YS�%]�	Ug6�45���3rՙfMUB��V;fMuƠ������Re6�35��뤓����>3��l0kj�Š*������x����o��fM�����l0kjlɛ�ՙfM�����l0ij\ɛrՙfMUB��g	����cP��`�T�`
�2̙K�u�ɋ)��7FU�fMM�Te6�3=t8O� p����r6�4̚[��A�:������������ƕ�l���l0k�rV�%�v,̚�:�A5f�9S]�)��l0gj,h�I'y$�9FU�fMM�Te6�3=��ϴ�y�v��H�a�� ��l$k�l��0[���%k���lUe6wI�2Wl6�Ue6wɚ���a��͎u�����Ta6wə�L!5fs��)�4�]'��
�FP5fs��)��j��n9�{Z��;�l�5Xv�!X���1kjl�������KN6��3L�Wr�A�:����Jȿ�Y�j�¬���Tc6�3�5�B��s��Ҁv�trà�dè*�������̆r���ty��h�o��eM���*�����f�lufCYS�fc�:����rf�\ufCYS��s�r	�����cP��P���`
�2ʙ*K�u����>��QUfCYS�/U���r�����t�љ�雍�*�Ʋ��c�3˚�#Ug6�4�GW��X�41�V;�eM��
H�A {���@�ᛍ��Ig�7EU��eM�&_I�:��w��LS�e���;�1kjlI���w̚
,)}��A��IS�JJ��w�c�T%�����5�u�j�s��SH��`��XЮ���
�K��w�c���AUf�3���:����<�����}=�p>�_�}X�Wh��|dN����v����G��+����Yg>�������u��?���?������d?w�߬�`�}dP�6sX�}�P��5�c%�G�7��!d�)}dR�K9 �2&ͤ���馄�T��� ViH�K5��� �ՙ�R�u T�a*ո�n�UgB�KU	%��v;�u�u�j�3��SH��`&�XЮ�S�
J� ��p0�j�Š*��L��=�+����f��T�efC�J��\��%f�luf��T�%fC�:��T�q%f�\uf��T��7,��ڱ0���0՘fRu��*��L��4�]'����͆QUf��T�/U��dR�ρ���|��\�����U���@e��}���Ff�",y�!T���T�J�w���ld�H�o,a�c�TY�1��ld����Re62��YЮ�N^W��0��ld*�����柞���Z���S�e�k�4̥[R��luf��T�%�k��2��R�+�\C�*�y`.U%��'��ٱ�K�u�*�恙T]�)��l�I5��뤓ZHŕk��1��RM�Tc6̤���Q[��Q{`.U`���}�:u���U��Cg��}�Ug6:u��rՙ�N@��V;��@����*l �D�������S���!M�t6Mi�����F'��}�P�
��V?�l�����,=� ��ll*�e'b�3���ZXv�T���T��N6�Ug66�%�_�(a�c�T^�1��ll�)��Re66�YЮ��na��l����������dC�U��f��_����G�&�u��u�eo6��D��fْ7d��&�%��K�l��MJ�ב+y�A��l"Xr���?K�;VKn�yƠ�l"H�n�k0��fA�7Sdi@�N:y1eP�fè*��\*����3���mM9��v��`.U`Y5�U��R�-飆luf��T�%}�Ug6�J5���rՙ�RUB���V;�RuƠ��L���Re6�I5��뤓�����1��l0�j�Š*��L��z9�_�rx�����M��~�G��^i>4�+{`@_��L�f�~�F�]gF4!�+w`H_��L�&�~��ss�.m�������v\cR47����V��N��ڠ���4E�;�O����2/���U�!p���\��i;s�oAױ�hKn�	���Ҵd�*    �%oA�VgV2[a�[��LJ&�2W��\u�$�UEB~O`	�Ln�yƠ3����SH�	�LUfi@�J:��*��-�QU�#�UY�Te62Wu���rk��
��f��4���lY��X3������@	Ug66Y��*��f�,��h�v;��O��@y�l�*��Re66SYЮ�Φ�2(�rk��٥�m�h���a�����fcsU	�v��F��?pe�:��+²��Ca��u	�â�Ug6�a	�{�XX4�%VY�1��l$�*k0�T���W���:��{T��H���AUfC���مe���~��P����oAc%��o7�a��W�:�l�7x�ނ�J�#p���ò��U��P����_��J�#x�n�2�﫶����6*���bh��n��쯴u�~{�˳��k�k�L�WY��5&�H.v9�'�����H6aɉ	au��H6����U��"�X��'&DU��"�X�OL�UgN��	�W�HX�`���u�j�Hr��SH�	I.�YЮ��ow��Ue:��e�bP��H.�~�^C=f��dc��Vi6��e�$�luf#�X�%� Bՙ�E2Tȕ䂐��l$+r��%�v,���:�A5f#�XY�)��l$�,h�I'�)Ź FU��dcY�Te6��=�n�S�����f��X�e� �U�fc�-�![��\%EE�$D�:��d�q%� �3�ƪ��-a	����cP��`.V�`
�2��K�u�I~�Aq.�QUf��X�/U��b���z�df��v��P6�`����l(�l��([��P6�`����l(�\��(W��P6�%�ܰ\�jǢl���Tc6���5�B�̆r��Ҁv�t��;�O�qT��P6V�AUfc�Z�u�ç��k%Xv�F�J��L��%�h�Vg6��5Xr�F�:���r%�h�Ug6�}u	�*�%�v,ʼ�:�A5fC9W_�)��l(ߪ,h�I'w����Ue6�iU�bP��P�us��#�p{;�l(�j��d��J�����'f�3ʰ,>� ��l(��\�Ɇ��̆2�.!�:	��2��cP��P~��`
�2ʯ*K�U�Q��A��FPUfCV�/U���W�k������2��5��*��2��5��ՙ�eX�k4Cՙ�%X�k4�3˰��h.a�cYO���Wa�:�G�h�H�_�є�J:K���h��2˰f�h*_��������q~�n���Ϳ}=�p>r�_�}X�Wh��|dY����v����G��+����Yg>�������u��k���?������d?w�߬�`�}d[�6sX�}�[��5�c%�G��7��!d�)}d]�K9 �2&̺�����;���M	�
,�h=�}g�[��z���lX��z��Nl5�������تJW���;+�X}Ơ
�Yq^���Rc<+�j5��뤳~�����jgŉ�&_�1���ޒ3�?��m6��k%Xv�F�:�Ymf+�%Wn�Ve6��l%Xr�F�*�Ymb+r%Wn�Ue6�Mle	�چ%�v,����0՘��k�5�B���f�"K�u��=<��+7FU��MlE�bP��ؼ��@���n��k%X�yzz���f�"[�yzz���f�,�<=���j[�+�<=���z�>���X�jǲ���cP��ؼV^�)��llV+�4�]'��}��ƨ*����(_�2̤nG�s:�z�v��X.�`�5�*��r�Ȗ\�![��X.�`�5����*�0ȕ\�!W��X.�%���ڱ,���0՘�eRy��*��L*�4�]'�ܭ3(�FcT��X.�AUf#�Z���:��mV�׊��dC�J����Ɩ�l���lpf�������'�Wr�A�:����*!�:f	�g��:�A5f��Zu��*��Y��Ҁv�trà�dè*����&_�2��zN�l�o����k%Xz���f��Tc�N6��l0�*��d3��S�ƕ�l��`.U%�_���l0���0՘fRu��*��L��4�]'��¤o6��2̥�|1��l$��X�>j���͆r�K�M�lUd��M�lU�e�f�Q[m�*reܦ�Q[m�*K(C���Q[m�*��Tc66W��`
�2���,h�Ig���>j��2����Š*���������˥,3�U���R�-1d�3˥,1Bՙ��R�+1�3˥���a��Վe�T^�1��l,��k0�T��eR���*�,�ʠ�lUe6�KE�bP��H&u9磩_Sf���UEX:�f�h�Uf�2[6�f�h�Uf�",�}3{4�*�U�+�}3}4�*�UEB��2}4�*�UeƠ�����SH���LUfi@�J:��*�d����ԫLVe�bP���\��u`��u~���UEXִ�`�f�YScK�v"[��`�T`I�NBՙ&M�+iډ\uf�YS��?��ݎ%�yƠ
�yb�T�`
�1�'�L���鞘4UPܴ�Q5f�Ĭ���j��9���T�����iYS�e�h�3��eM�-�FC�*�yZ֔`�5����iIS�J�ѐ��l��5e	�*�%�v,˚�:�A5fc9S^�)��l,g�,h�I'w����Ue6�5E�bP��H�����o���dM��#�^ ��Ȗ�#�^ �����.x�T���L/x�T�PZ�O/x^l�FZ  ���d�7�Y�$��0M�t6w#/T���T�/U���L���d�O7����dC�J�����%'d�3̚
,9���l0ij\������*��YB�u�V;fMuƠ������Re6�35��뤓[�'FU�fMM�Te6�3M�f�v����S��9��f�YSc�r6�����r6����ƕ�l�fMUB�j�7̚�:�A5f�9S]�)��l0gj,h�Igy��lUe6�55�bP��H��~�qn�N7̚
,�F#X���TdK�ѐ��ll*��k4Bՙ�M@E������&���|�V;��@�u�j����L!Ufc�O���:��n�A�5����&��|1��ld��r��o���dM��>��l$k�lI�3�ՙ�dM��>��l$i�\I�3rՙ�dMEB.�e	�K���cP��H�T�`
�2ə2K�u�I�:���gFU��dMY�Te6�3�t��/��)���h�,k�lYo���5%X�mz��%M�+�6�@���,��ך_ `YS^�1��l,g�k0�T���L���:鬏�@FU��eMQ�Te6�3=�n�L�~;�l0k*���f�4�'fM�-y��?��YS�%o6ӧx>1ij\ɛ��	�O̚��|�?z����cP��`�T�`
�2̙K�U�a�TA���i�O̚�|1��l,gzJG��N7ɚ",�F�>b�)YSfˮѦ�xJ�a�5��OI�2Wv�6}��S��"�\�L1𔬩��Tc6�3�5�B*�f=IΔYЮ�new��EU��k`g�k��#6HV�>�A�1��f�e��Ve6,�]� �l5f���TR�A�P5f��$i�\Y�f����2IX�nǲTR�A�WaIr��SH��HΔYЮ�N��Jr6��l6X;��l��l�hW�,hI{���N7̚
,4�U�fM�-2c�3̚
,2Aՙ&M�+2�3̚���a��Վ�YS]�1��l.���L!Uf�9Sci@�N:���������&_�2�i:p�y����eMN6�4˚�l���l,k��lUg6�48�0W��X�t�d#V;��z���j��l,g�ld6���zޮf��ƒ�'AU��eM��WA���gz�ٿ�n6�5%XV @�J���)�%�Vg6�5%XR @�:���)r%�Ug6�5e	���%�v,˚�:�A5fc9S^�)��l,g�,h�I'�0�Ue6�5E�bP���L�g�ܾ�n66Ӕ`i����h,���:���l$k���]��j�����C��Ug6�5	����j����IC��
H�&u�
l Yg�8��4u�Y_�<�)�*���)�����r�׼7���t���)����լ'ɚ2[6b`v���u^�{�!��l$i�\و���j6X�y=�&V;�dMeƠ������Re6�3e��뤳Y���7�q�ɎfW43�L�����n.Y�������@o(��}"�2    3<N~7���`#]S�/U�Fz��5�����8l�k��6ӓ:_�lW�'u�[l�k��6Ó:_�lW�'u�Wl�k*ʆ5=��%�v�tR���F����NY��$���I�lS�����NQU�F��_,����L�c6�<ld�)�2ؐ�62ה�ؠ[ld�)�ؐ�62Ք�ؠWld��D�GX�X2�T�a,����4�5�J�`#�L٥���dWgQVU�F��r|��
62������o�a#]S�e�!Y%ll�)�%�A�:��\S�%�!Ull�)z%�A�:��TS��7,��ڱl�)��XT�i�k0�T��晢K�5�m�4QV��f���_,��͆=��r;��4ڱO�fî�Ȳ�h$��͆]SsKN��[l6욊,9�F�*�l�45��4zU�fî�F�'�8�nǒs��cQl6��L%5�ٰgj.-dWE�MSŧ�XU�Z|��
6�3ݞ�k:���o�aC]S�E�1Y%l�k�nlԭ6�55Y S�������F��`C]S����v;��cQl�g�k0�T�f�}]]ZȮ����.�'l\U�j|��
6�3}=X<o�������Ȓ'�U����?ٰ[l�k*���Uu����y�O6�U�j��ױDX�X�5�u�j`s��e��*�`��\ZȮ���(|�Ul�kj�Ţ*�H��x,x��d�)ʲo6$��vM�-�f�nu����Ȓo6���6M�+�f�^u����F���9�j�®���XT��L%U�������]�|1eQ�͆UU�������`�=������ll���*a�]Ss�n�����ȲƟl�ij^��O6�5���>�d�]S]���6�3�5�J�`�=Ssi!�.:�A �Ul�kj�Ţ*�X���^W���q�H�e�$���tM�-�A ��`#]S�%7��6�4e������tM%Bn�s�Վ%]SY���6�3�5�J�`#=Svi!�.:�A�E�����tM9�XT陞�l�y�H�elHV	�k�n	lЭ66הd	lHU�j�^	lЫ66Ք#��#�v,�k��0���f��L%U��y���Bv]t���(���`cSM1�XT뙞9l^���uMI�γ���uM�-�g3뚒,�g3k��W6�f6�5�e&�<l�k��0���z��SIl�g�.-d�Eg�r؈�
6�5��bQl�g�P�<�K��uMI�� 0^�ܬk�n���ͺ�$�n�.un�4E����R�f]S�PZ���ͺ��cQl�g�k0�T��z���Bv]tv��B��U5�٭k��Ţ���3=��"��o�a��LS�e��HV�]暲[�ݪ`��\S�%��HU�]���W���`��TS��_�p�͎��\SY���6��4�5�Jj`��<Svi!�*:�h*��5��`#SM9�XT꙾=�g^�=�ac]S�e�N�U�ƺ�薔:ѭ6�5%YR�$Ul�i�^I���`c]S����a�cIה�a,����Ly��*�X�]ZȮ�n��)��R'��`c]S�/U�g���*}���|�v6�5Y��d�����얼FC�:��\S�%��HU�j�^�k4����L5��UG��X�.��a,����4�5�J�`s�����BvUt2�TD�k4VU�F��r|��
62��x���^���vM��i(���vM��i�V����PUm����ث6�5͇�I�Վ�]�tx���F��L��i�I�3����M]t�4͇���
6�5M��q|��׮��i��5گߎ�f���3��=���h�e�ܲ���k�߲�,�ٌ�F�-����l�^��Sֻk�G(]���h�em+�0���淤}e���-���t]pi!�.�ۊ(��̽F�-kag����k�ߒxW�o�����9xWGY�U���]��bذ[l��Q�Uu�9yWg�6�U��wu�7,��ڱN��eƢ؜���L%U�9y_g����]]D!lDU�sagG�p|�$�[���O6�me6���N��Ɇd��9�utK�lЭ6w�k�dɓ��`s����+y�A�:����u���:���.��:�E5���_�SIl���:���]���aQ�dê*��vv~���*I������㰹ˮN�������Cvutˎ>�?�<d_'Yv�y���!�:zeG��l��s�r|v���!;;��XT����SIl���K�u�ɮ΢������cag����O6�շ������yҮ.��"N�U��I���%q�[l����,���Tu�yҮn^�E��U�'��!_��V;֓vv]���6O��u��*�<i_7��뢣]]E�E�����sag�81�B������sn��oY��:���j�F�����[v]�܈�߲��u�e�Ռ��-��Vg�캚��e����\y27b�,��]�a,�������L%5��^��uvi!�.:~#�亚����-��r]�Ԉ�ߒ���������w�$���q�l��t��4.���}G���w�|p����}GwQ�)�:�l�w�>}g��:�l���O�}ۥ>�W�R������K%5xپ���](����}��P�Z��}�$�k������J����_���b��o����_�$˞aHV��]�.G��������$K�aHU��]�*G���� ��_�!��v���u��0�@f���y��*�\��rti!�*���oaQ�ê*�\vv~���*IvF}���<l�vJ}�4�U��j��nAC�:�\��߂F�:�\�}�pz���j���[�8�nǲ�Q|��B�ͺG�-h�I�;�oAC���n�<Z��UU��-��Ҩ���Mv�x&��o�ac��x&��*ac��x&�����Z��LNQ���:��LN󪃍�J㙜a�cY�4�ɩ���$;{8�SW`#I��t&���E'�z<�SUU��Vi8���$�y��#�+����V�Ȓsg(���J�->w�nu��V���sg���vJ�+>w�^u��V�F�g�$�j��V���XTl��L%U��F����]�dQx�LTU��V����`����r��O6_���JE�r&Y%l�Ujn�!gt���JE�r&Ul�Sj^�!g����J5B>(�V;�JuƢ�`�T�`*��6Jͥ����|:��Cά���J-�XTi�������o�a#�R�eӐ�6�*e��bt����JQ�\LC�:�H�����iЫ6�*��r��ڱ�U*�0��F��SIl�Q�.-d�E'7��(���UU��V)���`c��[ިy�v6�*Y�͆d���V��%�lЭ6�*Y�͆Tu��N�y%�lЫ6�*���?GX�X�*�u�j`��R]���
6�(5��뢓/�,��ٰ�
6�*��bQl�Q������4ln�*Y��du��a��ܒ�h�V��JE��F#Uln�)5��5zU�憭R��_�p�͎u�V���XT�6Ju���ܰQj.-d�E'��Y�FcUln�*��bQln�(���^��͏V�Yֳ!Y%l~�J?�%=t��͏f�Yҳ!Ul~4K?y%=���͏v�����V;֏~��u�j`�]�q��*���~ri!�.:�#�(�ٰ�
6?z���EU�����0�s~��M��(�^���Iהݒ�h��n�5EY�m|��M��야F�&p���Dȯb�	ܤk*�0��Fz��SIl�g�.-dWE'MSů��	ܮ;;�F�&p���=`���uMI��d����)�e�!�:�Xהdl@Uk��W򪃍uM9Bٰ0�nǲ��a,����Ly��*�X�]ZȮ�Κ�,J`��*�X��EU����v�=��<��`�Td�7�U����|�A�:�`�Td�7R�����|�A�:�`�T#���a�c�v^���6�3�5�J�`�=Ssi!�*:l��(�fê*�`���EU�������>�v6�5EY����7隲[����7隢,�����4M�+�����tM%Bް�>ߤk*�0��Fz��SIl�g�.-d�E'�z|�YUU���)���`#�K�=�A��㰑�(���62��ݒ�V�`��� ��`#�K�+9 �^u����!d��K&��:�E5��饲    SIldr)���]���aQ|@�UU����_,����LO6��'욊,{�!Y%l�kjnɓ�����"K�lHUl��W�d�^u����F�s�Վ�]S]���6�3�5�J�`�=Ssi!�.:yâ�ɆUU�������`�=��?t��F{�uӰ����2ؐ�66��ؠ[ll�)�ؐ�66��ؠWll~)G�GX�X6���a,���M/�5�J�`c�Kѥ���dWgQVU���b|��
66�4~����q�X�4~�&�:��5�_��[l뚦��DU�Ú��k4��a]��5�F��X�uM��h�
I��4���k��z��k4���ξ�.�f�5�a]��5��WI�]}{\�3�����4lꚚ,���*aC]Su`�nu�����ؘ�6�4U� 6�U�z�?7,��ڱ�k��0���z��SIl�g�.-d�E����	WU����_,���L�Wl��l���^���Հ�6�55��r��vME�]W�:�`�Լ��jȫ6�5�����ڱ�k��0��{��SIl�gj.-d�Eg� (��UU�������`s�9�����z�i�`�Td�<�U����̳A�:�`�Td�<R�����̳A�:�`�T#�(a�ca�T�a,���Lu��*�`��\ZȮ���*��ٰ�
6�5��bQl�gz��F{�v66Ӕd��󰱹����<�kJ����q��TS��n}���M5����y��\S^���66Ӕ�`*����3E�������,Jn}���M5��bQl�g���岽�/<$�ߏC�:���x>�+�C�ӏ��>��A�:����>��`DMԏ��>z�A�:������}������풸R�O��fW�U����G�3�"���gq?��Y]/�~�uI\1�^.��>1}�v^�aY��$�Jha��ܢ'&s��vXE=1��R�`5��ɼ���V�����;��cQ����k0�TA����Bv]t�vGE������V�/U�F�������o�a�V�e@�����<0�:�ؼ������`c�R��U��<���楆t6�dVjx�@W`#I椦̦.:��<PUllZjx���$ѹ��e����~�v6�a5Yx�Zd�����EG�ͭ6�a5Yt�ZTu���zEG�ͫ6�a��X�FX�X�a�u�j`C�U_���
6�_U��뢣��*
�T��
6�a��bQldV�kM�O6��;������5�U�;��ܹ�nU�9��*���5RU����y%w��WlN�j�|oG��X'vXuƢ
؜�_�5�Jj`sb�\ZȮ�N�dQ|��j`sb���E5�9���z���o6_���͉�RE��F#YlN���n�k4t����KEY��Tu��i�야FC�:�ȴT��_�p�Վ%�ReƢ�ȬTY���
62'�]ZȮ�Nޭ�(~�ƪ*�ȴT�/U��G������{��qp�~=�=֏�~ 磴:�����k߱�ٵ<?���}G�Ge|~4Z?{�?�=� �����8�mc����~t[��>�5 ��m����eU0��o���R�]��w�?�/)������9�a���zl��l����t�Vʒb)�*�$}Wv����V#黢,.���D�ve��X�^u���D��D��ڹ��*�0��G���SIx���.-d�E�mW��RQUG��_,��v]/��N���8l��*��4�*a�}WsK�I�[l��*��4��`�mW�J�I�Wl���Q[��ڱ���0�����SIl��j.-dWE�mW�ǤYU�Z|��
6�u}�C���o�a�sUE��f��g��[��'��*�6�O68Yռ2��?��dU�P6��'����0����L%U������BvUt8UUE	l�lp�����`csUc�|�v66W5���*a��TsK.���^�Ȓ�@�a��T�J.���^�F�J��`/U�a,��vRu��*�`'�\ZȮ�[�*�/���^����`����Ep�ɵ�ߎ�{�"K/�?�&�U�-�t���VEYv���5���^�e��'�d��D(JΟ\�٪�cQld����TR���.-d�Eg7�'�TU����Ţ*�H'�|��l�~;��*��2P�U�g��[r(���g��,��Tu��ɪ�\�^u��ɪ!_(�V;�V�u�j`�sUu��*��LUsi!�.:�!�E�e����NV��bQlp��~9n�k��ߎ��z�$�
�$����R�-)��[l��J�� J�*�ܭ��^I��`s�^*G�%B��ٱ��K�u�*`s�N*��TR��uRѥ��褕ʢ� ʪ�ܭ���Ţ�ܱ�z�\�G~@�~L�掽T�eHV�;�R�-9 �nU��c/Ud�R��[��@�:�`/U#��a�ca/U�a,��vRu��*�`'�\ZȮ�NN°(> ��*�`/��EU��N�v9.����o�aCsUM��lHV	���nI���`�K+�dIφTu��ɪ��lЫ62YU"�GX�X2[U�a,����U�5�J�`#3U٥��褏Ģ�gê*��dU�/U����g~��?�i��\U�e��HV	����A��4���F��(KN���6�4e��4z��F��!�h��K���cQl�g*k0�T�Fz���Bv]tr��E�i4VU�F��_,����Lo��\�a#sUQ���d������%�A�:�`�Td	lHUl��W���vM5Bް8�j�®���XT��L%U�������]���,�aê*�`���EU�������頵_��uMM�#Y%l�k�n�8s��uMM�#Ul�i�^�8�uM=B��^#�v,��:�E5������TRꙪK�U�Q��E�8UU����_,���L��y�O���#���5Yv�y~����}�A}Ǯ�Ȓ��㣧��45�������;vM5B>>;?j��]S]���6�3�5�J�`�=Ssi!�*:l��(>�<?J��]S�/U�{���ؓ���v6�5Yv��d�����}F�:��T�%G�IU���^��g����L@���,G��Xrz��a,����?�5�J�`#�O٥���d����Ϭ���L@��bQl�g��'�A�������һ��_�a��ܲ���_�a�Td��h�Ѱij^��h�Ѱk���Z�Ѱk��0��{��SIl�gj.-d�Eg�8�7��
6�5��bQl�g�]n�7�_��vME���l�kjn�������"K�����y%��<�k��G��o6��:�E�y`�T�`*���{���Bv]tr&�f��<�kj�Ţ�<�g��U}���~;�uMMYl�5U�耀�U��A]S�EDU�5M�+: `^u����G�3�9�jǢ����XT��L%U�������]��QQp@@UU�������`�=��x��!]��p��!]��p��!]��h�汯t����<�k���<�k���<�g���<�g���<�i���<�k���<�g�_��%? p�����"���6�55�� ����*�MI� Ul�ij^����vM5B���V;vMuƢ�`�T�`*���Lͥ����$�����vM-�XT왾��Y�v?������һ�Ə>?l�)�ew��}~�\S�ew�M}~�TS���F?������ܯ5~��asMyƢ��LS^���
66�]ZȮ���q\�ƪ*��TS�/U�Fz��~����q��LS�ew���68��ܒ��Э68�Td��h���N55��n4���N5�e���7�k��0��g��L%U��y���Bv]tr�#���XU�jj�Ţ*��L��r_����{6隢,y���J�Hה���h�V隢,~���:�HӔ���h�U�J��*F"�v,��:�E5������TR陲K�U�I�TD�k4QU�F��_,����4=�l�)ɲ$����5e�� ���F暢,9 @�:��TS�J�Wld��D��9�nǒ1�cQld����TR�g�.-dWE'ME`Uld�)���`�g�_�    ���؞����?�Ώ��Gi?��QZ	���Ϯ}��g�:���~��=�u���<���w�|��Џ�������!�n'����a}.k@�������˪`����٭���Q� 쾤��ҏN��(�U`�Nꋀg�}���q(Y/�d�S�*�d�TtK��ЭF�K%Y�D�:Y+��� �����R9B�K�#lv���RyƢ
�<���k0�Ԁ�i�Tti!�.:ycâ�)�U5�yZ/�E5�yZ'��Z{�v6O�*�6$���g��[t���g��,���`��	�����`��	�!oXa�c�T]���68�T�`*���>5��뢓]�E1lXU��j�Ţ*�����r>��;_���RE��M�J�`/�ܒ�ѭ6�KYrC4��`��T�Jn�F�:��r�/Gȷs�Վ��T]���6�I�5�J�`��Tsi!�.:���E�Ѭ���R-�XT줾�c�'׾~;쥊,�䌟\{b/�ܲN��ɵ'�RE�ur�O�=��_JO��Wl���J�c���{��cQl���k0�T�;���Bv]t�]JO���
6�K��bQl���ޣ����^�Ȳ���Q{b/�ܒ���Q{b/Ud�m���=��j^�m���=���rc}��'�RuƢ�`'U�`*��vRͥ���䶁�5WU�{�_,��vR�籏�N�1쥊,�䀬6�K5���Cnu��^�ȲN��`��T��:9�U�j�����{��cQl���k0�T�;���Bv]t�]BQ��AUl��j�Ţ*�`'�E�G�����q�H/eٓ�*a#�TvK�lЭ6�KEY�dC�:�H+���'�����R%B��#�v,��:�E5��N���TR餲K�u��[�O6�����R9�XT�n��e�4�e�4��RI��F#Y%l���n�i4t����RI��F#Ul���^�i4�����R9B>��V;��RyƢ�X'��`*���uRѥ��謕ʢ�4��`c�T�/U�F柞�G~����i���S�e��HV	��jn�i4t���@Yr�Tu��	�敜FC�:��T��O4q�ݎ%�yƢ���S]���
68��\ZȮ����(>�ƪ*��T�/U��柾���!l~�v6�55Y6h�d������%��Э6�55Y2h�Tu����z%��Ы6�5�yXG��X2+��a,�߇��B=S_���6/I2%]ZȮ��%Jf�(�ƪ
ؼd-��<h�$ɮ~�氹^�a�%�:�2ؐ�
6/Y���[t���K���$K`C�ؼDɮ�^	lЫ6/Y��s��aq�Վe3PyƢ���S^���
66�]ZȮ�NvuŰaUll*���`�=��r\��7_���tMQ� Y%l�k�n�t���tMQ� Ul�i�^�����tM%B���V;�.'bxƢ�H�T�`*����L٥����$������tM9�XT��y����q�`�Td�7�U�Ff��[����`#3PQ�|�!Uld*{%�lЫ6Wy���{��ڱd���XT�*k0�T�Ff��K�u��S��lXU����Ţ*�����簹�㰑�)�2ؐ�6�5e�6�V隢,���`#MS�J`�^u����D�GX�X�5�u�j`#=SY���
6�3e��뢓]�E1lXU�r|��
6�3}������_��uMM�}�!Y%l�k�n�7t��uMM�|�!Ul�i�^�7���uM=B~��V;uM}Ƣ�P���`*���Lե����)��o6���uM5�XT꙾���R�ߎÆ��&a#�J�P�T�"ؘ[l�kj�6���5M�+��y�����!lXa�cQ���a,���L}��*�P�T]ZȮ��vu�QUl�k��Ţ*�H����|�v62�e�k��y6/Y�&�gcnu����Ȓ�h��l^��-L<�Ƽ�`�]S��_Ōϳyɒw1�<]��$yγ��H����<���Nޭ��lTU�Z|��
6�3=.���o�a#�OQ�� ��J�`����ح6�5Y|� ��`�MS�o`�:�`�T#��DX�X�5�u�j`�=S]���
6�35����æ���DU�Z|��
6�3}����G��v6�5%Y�͆d����)�%�lЭ6�5%Y�͆Tu���)z%�lЫ6�5���?G��X��a,����Ly���l�3E��k�۬iʢ���j`�Y��E5��p���z�����o�a��LS��#�l8��ܲ�6�k*�l�������W6b`����SM5B��~����sMuƢ
�l8�T�`*���35����É�*JF��p�����`�3M߃s�~�v6�5Y:<m�����O�A`î�Ȳ�i�7l�45�lx��vM5B�5~���]S]���6�M��n��H��w�jS�ͽopUl�kj�Ţ*��L�3�A���q�Xהd����h�uM�-; 0�m��)ɲӯ�6k��Wv@`�5�f]S�P>2��Fۮv"&�A@Va#�Nä7�
l$�I������N��7��
6�5��bQl�g�]��6_��vME�@Y%l�kjn�v��vME@Ul�ij^����vM5B��,V;vMuƢ�`�T�`*���Lͥ����$������vM-�XT��/�k��ߎ�Ff��,��I�J��\StK&u�[ll�)ɒI�����M5E�dR'z��Ʀ�r�<�#�v,�k��0���f��L%U��y���Bv]t2єE�NVU�Ʀ�b|��
62��<��9ǯ��d�)���h���l2הݲ�h���l2�e�k���j6�j�^�k���j6�j*ʫ���j6�k*�0��Ff��L%U��y���Bv]t�n}�VU�F��r|��
6�3}\�3����㰡���£�"��uM�-:�lnu����ɢ�Ϣ��5M�+:�l^u����G�g5�jǢ����XT��L%U�������]�ZWQp�YUU�������`c3M�tR��o�ac3MI���&Y%l�k�n�Xht���tMQ���&Ul�i�^�Xh����tM%B-�V;�tMeƢ�H�T�`*����L٥���dV5��Ь���tM9�XT�^���h�~;�i*�����huM�-; 0~7�F]S�e��Fۨi�^����6�z��y�n�����cQl�g�k0�T��z���BvMt;5M]��m�����j`�S��]��S�|�v6�uMI��:IV�ݺ�薔:ѭ
6�uMI��:IU�ݚ�蕔:ѫ
6�uM9B.r�ݎ%]S^���6��Ly�����3E������)��R'��`c]S�/U�Fz��%}����q�`�Td��U�F暲[r@ ��`#sMQ� Uld�){%Ы62�T"��a�cɉ^���62�T�`*���.'aХ���d��������L5��bQll��#���㰱��$˞lHV	隲[�d�nu���)ʒ'R��F���<٠Wl�k*�_�a�cI�T�a,���U�b�5�J�`#=Svi!�.:yâ�ɆUU���)���`c=���m66Ӕd��y��\Ӆ't����5͟lHU�j��d�^u�ѩ�O6a�c�\��ɆWa#�f��O6�I6�4�A���l����`�SM�'���$�����ߎÆ��&ˆ���68��ܒ�i�V�k*�dx��`�SM�+��^u����!�����:�E5�����SIlp�����]�̽cQ<<�UU����_,���L�����j^��vME�}��vM�-;�<욊,;�<l��Wv�y6�5����<l�k��0��{��SIl�gj.-d�Eg����jDU�Z|��
6�3=������6Ꚛ,�fC�J��\SvK�٠[ld�)ʒo6����L5e��z��F��J��ޟ#�v,�k*�0��Ff��L%U��y���Bv]t�ŔE�7VU�F��r|��
68��E��%�ym�Ӱ��)ɲ'�U�ƺ��<٠[l�kJ��ɆTu���)z%O6�U�r���1GX�X�5�u�j`c=S^���
6�3E��뢓�0,��lXU�b    |��
6�3�/�c����i�`�Td��U����@�:�`�Td�R�����@�:�`�T#��a�ca�T�a,���Lu��*�`��\ZȮ�NN°(> ���\�kj�Ţ�\�g�z��o���4l��5�oYl��5�o0�*�\�k��  �*�\�i� `^U��Z�4�A@#lv��uM�t����ۿ$�{��]��$y��� `6it�(k��7�*�M$kag��hK7D��̞�����%�D��ɲ�h$�l"Y�ݒ�h��&�%�`H��F#U�H���A��5z尉dɛ��_�p�ݎ%�bxƢ�`�T�`*���Lͥ���vy�΢�5��`�]S�/U�Fz��c��c�@$�IHV	�.@�:�h�4? @�:�h�t� z��F��8�nǲ�i|@�Wa!I{��^��$��Ц*:m�.`Ul�k��*I2!i�n����h�,���p7�*a#]SvK��-ލɒ9I��h����4M�+��x7Z$K��-܍&V;�tMeƢ�H�T�`*����L٥���d����h����tM9�XT�>��h_���4Yv@�d������@�:��\S�%HU�j�^�����L5��#3GX�X2�T�a,����4�5�J�`#�L٥����$������L5��bQlt�i�����4�a��J��\Sv��B��F暢,=�j�^�X�y��TS�PF��F��:�E5�����SIld�)���]�ͪ�a#�*��TS�/U�Ff����i_���tMQ��fqxZ$Kv�xx����F��(K`�6<-%�z<<ͼ�`#]S��7���i�,����i�
I�����t6�d_O���M]t�����TU�r|��
6�3�.���F{�v6�5EYre����)�ŧ�ح6�5EY|Uu���){ŧ�ث6�5��D�DX�X�5�u�j`#=SY���
6�3e�����"
O���
6�5��bQl�g�~��O��~;隢,}�6M��얽F�?�&]S�e���O�IӔ���h�Ѥk*ʫ���h�5�u�j`#=SY���
6�3e��뢳w��i4QU�F��_,���Mz���}6�i�ܤk��6 ���M�����ܪ`s��)�2؀�
67i��W��M���lXa�cݤk*�0U��&=SY���67陲K�u�ٮ��6����M��_,����L�#?����8ld�)ʲ�h$����5E��4����暒,9�F�:��TS�JN��Wll�)G�'�8�jǲ���cQll�)��TR�g�.-dWEgMY�FcUl����O�a|�$�����u5�~;Ꚛ,�g#�J�P�Tݢy6�VꚚ,�g#�:�P�T��y6�U�z�0E#�v,����0���z��SIl�g�.-dWEGMS�lTU�����l,�J�LH����~�v6�55Y6<�d������%��Э6�55Y2<�Tu����z%��Ы6�5�y G��X2���a,���L}��*�P�T]ZȮ����.�����
6�5��bQl�g���#���o�aC]S�eO6$���55�����`�sME�<ِ�68�Լ�'���N5���c��ڱp����XT�i�k0�T�癚K�u��[�O6���N5��bQl�gz���o�a#]S�ew���6�5e��n4t���tMQ�܍F�:�HӔ����Ы6�5��~-��ڱ�k*�0��Fz��SIl�g�.-d�E'�8�(��UU���)���`#=�������q�H�e��U�F���@�:�H�e�R��F���@�:�H�T"��a�cI�T�a,����Le��*�Hϔ]ZȮ�NN°(> ��*�Hה�EU�����}��ȿ�܎q�P��d�7�U���|�A�:�P��d�7R������|�A�:�P��#���a�cQ���a,���L}��*�P�T]ZȮ�N���(�fê*�P�T�EU������������q�Xהd�u5�O6�5E�캚�'뚒,��f��ƚ��]W3�dc]S�P�<����)��XT��L%U���)���]���?و�
6�5��bQll��m�gs?�|H�e�k4���搮)�%��Э
6�tMQ��F#Uli��W���`sH�T"�W1a�c�5�u�*`sH�T�`*���!=Svi!�.:y�΢�5�j`sHה�E5�9l���x=�L��f��,��J�Hהݲ�i�V隢,��:�HӔ���i�U�J�2�#�v,��:�E5������TR陲K�u���;%��PU�r|��
6�������q��LS������F暲[v]�<ld�)ʲ�j�a#SM�+��f62�T"�+O�a#sMeƢ��LSY���
62ϔ]ZȮ�N&��(��f62Ք�EU��ڄ�|���㰑��(K����:�k�n���R�!sMQ�O�.u2Ք���i��C��J�2�k��y�\SY���62�T�`*����3e�������"J����:�j��Ţ*��L��r;R�|�v68�TdɈ�U�皚[<b���`�sME�@Ulp��y�#ث68�T#�k�%�n���cQlp����TR�gj.-dWE�MU�Ulp�����`#3M�����o㰱�)ɲo6$���uM�-�f�nu���)ɒo6����5M�+�f�^u���)G���9�jǲ�)��XT��L%U���)���]�|1eQ�͆UU���)���`�=��������o�a�]S����Ə>�55�lx������"ˆ�M}>�ij^����vM5B�5~�������XT��L%U�������]�ͽK�>��
6�5��bQl�g�����h�Ӱ���"Ka3�M���ح6:�4~���:��T��5{��F����$�j�ҹ��k4Y��$����h�I��ǯ�ئ.:����h����N5M_�q|�$y��:�~;�i����|������%�l�K�vME�|�/u�45���|�����F����K�vMuƢ�`�T�`*���Lͥ����i\�TUl�kj�Ţ*�H��|.܍����uMI��F��i]St�N���洮)ɲ�hӰ9�i�^�i�q؜�5��D�8lN��:�E�9�g�k0���洞)���]��o\��U5�9�k��Ţ؜�3}�=��o�asJ�e)l�{6��5E�6�=��暒,��t�洩���f�gs�TS�P6���isMyƢ��LS^���
66�]ZȮ��v��g#�*��TS�/U�Fz�����:��8lvi$�,+u��6�5E��ԉnu���)ɒR'��`cMS�JJ��U�r�\��˺��cQl�g�k0�T��z���Bv]t�4eQ\�dUl�k��Ţ*�H��|��>���8l��:ɲ'�U�ƺ��<٠[l�kJ��ɆTu���)z%O6�U�r���1GX�X�5�u�j`c=S^���
6�3E������)��'VU�ƺ�_,����L���u5��k4욊,��y�5vM�-��y�5vME���<������<�����<����cQl�g�k0�T�{���BvUt�4UQr���k4�Z|��
6�3}�C����a#]S���Y%l�k�nlȭ6�5EYP��F�������`#]S�P6,��۱lg�u�j`#=SY���
6�3e��������ؠ�
6�5��bQl�g��xwu�ac3MI�� 0>b������ 0>b����(�n�1p�TS��n1p�TS�PZ��#N�k*�0��Ff��L%U��y���Bv]tv�@>b@TU����_,����4ͯ�y�����4ͯ�AY%l�kjn�X���jN욊,=}]͉MS���B�_Wsb�T#�����՜�5�u�j`�=S]���
6�35��뢳Y��u5���vM-�XT왾�� ��/���"˞l�ld�)�%O662�eɓ�<ld�){%O662�T"俎�ld����XT�i*k0�T�F晲K�u��[�؈�
62Ք�EU������K�'���뚒,{�!Y%l�k�nɓ�U��n]S�%O6����ݚ��<٠Wl��5���c��ٱ��5�u�*    `s��)��TR���Lѥ����-��'V���n]S�/���.=��X�fs���K�eٓ��`s����<٠[ll�)ɒ'R��Ʀ��W�d�^u����!�u�V;��5�u�j`c3My��*��<Sti!�.:yâ�ɆUU����_,����L���_���uM�[�EV	�ݦ���հ[lt�i|]��`�SM��jث6:�4��F"�v,�k�^W#���d3M��jd6�l�i|]��EgM��jDU�j�^W��5��gz��ƿ�ܭkJ��5�*as�w0薼FC�:�Xהd�k4R��ƚ�蕼FC�:�Xה#�W1a�cYה�a,����Ly��*�X�]ZȮ�Nޭ�(~�ƪ*�X��EU������\o�u5�~;Ꚛ,���*aC]Su`�nu�����ؘ�6�4U� 6�U�z�?7,��ڱ�k��0���z��SIl�g�.-dWEGMS�6���uM5�XT陞����w隢,}�? p��)�eO6��k����f���4M�+{��?  ]S�P�:�?  ]SY���6�3�5�J�`#=Svi!�*:i��(y��?  ]S�/U�Fz��}a��}���tMQ��F��f#]Sv�N�����)ʲ�h��l�i�^�i��o6�5��D��7��:�E5������TR陲K�U�I�TD�i��o6�5��bQl�gz^�9l.�q�XהdlHV	뚢[t���uMI���Tu���)z%�A�:�Xה#��#�v,��:�E5���)��TR뙢K�u�ɮ΢6����uM1�XT��/����A�i�H�e�i�����5e��4���g隢,;�6~�Y��앝F�?�,]S�PN4�}�����XT��L%U���)���]��ȍ>��
6�5��bQl�g��8t�#~�v6�55Yv@�d������%Э6�55Yr@�TU�yP�T���U�uM=B���6;փ���cQl�3�5�Jj`󠞩���]���aQ|@�U5�yP�T�E5�y�LӅ������i�p��du�y�\Ӆ���V���5͏>��6:�t��3z��F��.}��K��G�y6�l�i|��W`#���G�Ѧ.:�h�p��UU�ѩ���g���D��v�]��i_��vME�Fd������E�1�:�촯�,����`�MS�`c^u����F�FX�X�5�u�j`�=S]���
6�35��뢣]]ElTU�Z|��
6�3=�|R��㰑�)ʲ�jHV	隲[r]����*7Ð,���Tu���){%�ՠWl�k*�'a�cI�T�a,����Le��*�Hϔ]ZȮ�N�aQ|]��`#]S�/U��z��B�f��<l�)ɲ�h$����5e��5���F暢,y�F�:��TS�J^��Wld��Dȯb8�jǒ���cQld����TR�g�.-d�E'��Y�FcUld�)���`#3M�g��o�a#]S�eO6$���tM�-y�A�:�H�eɓ��`#MS�J�lЫ6�5���c��ڱ�k*�0��Fz��SIl�g�.-dWE'MS�O6����tM9�XT�n���f���ƺ�$˞lHV	뚢[�d�nu���)ɒ'R��ƚ��<٠Wl�k��_�a�c���cQl�g�k0�T��z���BvUt�4eQ�dê*�X��EU�����l^���uMI��F��<�k�n�k���ú�$�^�M�l�4E��5�x��a]S�P^Ō�l�5�u�j`c=S^���
6�3E������)���h�=��uM1�XT�n��-���o�a�]S�e��HV	욚[r��`�]S�%��HUl��Wr��`�]S��O4q�Վ�]S]���6�3�5�J�`�=Ssi!�.:9�Ȣ�4��`�]S�/U��f�>N�=�O��LS���l�O��\Sv˾�̟F���(˾ٌ�F����}�?�����G(���O�=e����XT���4�5�Jj`�y���Bv]t��t�4�j`󔩦_,����f�ሁ_����Ӻ�$�^���6O뚢[�ݪ`�)ɒ�h����Ӛ�蕼FC�:�Xה#�W1a�cYה�a,����Ly��*�X�]ZȮ�Nޭ�(~�ƪ*�X��EU����ׅ�����hO�iJ��Ɇd������<٠[ld�)ʒ'R��f����+y�A�:��TS���:��K��:�E5�����SIld�)���]���aQ�dê*��TS�/U�Ff���-�9o㰑�)ʲ'�U��暢[�d�nu����$K�lHU�����^ɓz��Ʀ�r���1GX�X6ה�a,����4�5�J�`c�Lѥ����-��'VU�Ʀ�b|��
6�3�.�xoIӰ���Ȓ(��vM�-> �nu���������6M�+> �^u����F��%�j�®���XT��L%U�������]��Qx@@TU�������`#=���x�v6�5EY6b�d����)�%#Э6�5EY2b�Tu���){%#Ы6�5���z��ڱ�k*�0��Fz��SIl�g�.-d�E'�4X�`Ul�k��Ţ*��L�s�gs����)���h��l�k�n�k��o6�5%Y�m���5M�+{�6��ƺ������fc]S^���6�3�5�J�`c=Sti!�*:k��(y�6��ƺ�_,���L��e?��~;Ꚛ,�g#�J�P�Tݢy6�VꚚ,�g#�:�P�T��y6�U�z�0E#�v,����0���z��SIl�g�.-dWEGMS�lTU�j|��
6�3�����~;Ꚛ,���ꚪ[���55Y���4U�6��k�ʆ5@����cQl�g�k0�T��z���BvUt�4uQ���5��bQl�g�>����8l�k*�����d�]SsKn�O6�5Yr����6M�+�A�/<�`�T#���������0�o��-InȞl|6�����Fmꢓ�'W����-kag�f�lޒ춯G��f�����j�}�,�d5�y˲���-���*`�e�}�,�T�y��۾�+���*`�e]S�P����˺��cQl�g�k0�T��z���Bv]tv�#����PU�b|��
6�3}ϟNa��㰡�����h"��uM�-z�fnu����ɢ�h���5M�+z�f^u���M�F�s��l�k��0���z��SIl�g�.-d�EG��U�FSUl�k��Ţ*�P����c��v6�55Y���oY���c�խ6�55Y���oQ���c�ի6W��ӱ�a�cQ���a,���L}��*�P�T]ZȮ�Nv�t,���`C]S�/U�{������h_���tMQ�}�!Y%l�k�n�7t���tMQ�|�!Ul�i�^�7����tM%B�c?|7�[��a�u�j`#=SY���
6�3e��뢓/�,��ٰ�
6�5��bQl�gz�����a�]S���Y%l�kjnlȭ6�5YP���������`�]S�P6,��ڱ�k��0��{��SIl�gj.-d�Eg�:�ؠ�
6�5��bQll��0b���f3MI�]�I�J�Hהݒ�8ѭ6�5EYr'��`#MS�J.�D�:�H�T"��9�jǒ����XT��L%U���)���]���ˢ�"NVU�F��_,���L_T{�w��~;�i*��Ɇd������<٠[lp��Ȓ'R�����W�d�^u����!�u�V;�5�u�j`�3Mu��*��<Ssi!�*:�h���ɆUU����_,���4}?B-�l��=��,{�г!Y%ll�)�e�ц{6oY�&�ِ�66����h�=��,{�г������=^��${�lx�l�)���]�M4eQ�m�gcSM1�XT�i�_������욊,�ِ�62הݒ����F暢,�ِ�62Ք���z��F��J�����KZI�cQl6��L%5��d�)���]�&ME�lXU�M��r|��6��L���'��4l6욊,}�Yl6욚[�dCnU�ٰk*���TU�ٰij^ٓyU�fî�F(c�Վ�]S]���6�3�5�J�`�=Ssi!�.:{����UU�������`#=�c��c�Թ�LS�e�    K���5]�A���`csM�PU�j�p� {��Ʀ�.�  V;�.'b�d6��4L|����F����o`����$������M5�o��*I��?�I��ߎ��f��,��*a#sM�-����F暢,���`#SM�+�z��F��J��aq�Վu����a,����4�5�J�`#�L٥���dWgQVU�F��r|��
6�3}��Gz���o�aC]S��7��6�5U��s��uMM�  �:�P�T��̫6�5����V;uM}Ƣ�P���`*���Lե����7��
6�5��bQl�g�_I��y�`�Td٤N�U��暢[2���`csMI�L�$Ull�)z%�:ѫ66Ք#�i�a�c�\S^���66Ӕ�`*����3E��뢓��,�'u��
66��EU�����}��}���uMI��F#Y%l�k�n�k4t���uMI��F#Ul�i�^�k4����uM9B~�V;�uMyƢ�Xϔ�`*����Lѥ�����:���h����uM1�XT�izY}��eg�B��6�55�����X�,;嘏�&Ul�ij^�����oYvz}a,4GX�X�5�u�j`�=S]���
6�35��뢳S�c�YU�Z|��
6�3}�CGZ����8l�k*�6$��vM�-������"K`C�:�`�ԼؠWl�k���V;vMuƢ�`�T�`*���Lͥ���i��6���vM-�XT��G��~;욊,������6�4>�lnu������gQ��Ʀ��G�ͫ66�4>��v;���£Ϻ
I�H
�>�
��%��35��k��m�i|�YU5��m�ix���$ɛ�[����i���5Y�͆du��e�)�%�lЭ
6��5EY�͆TU��e�){%�lЫ
6�L5���?G��X��a,���.3Me��*��<Svi!�*:�h*�����`#SM9�XT�iz�ҋ8�~;隢,;�F�J�Hהݒ�h�V隢,9�F�:�HӔ���h�U�J�|��#�v,��:�E5���#��TR陲K�u���Fŧ�XU�r|��
6�3}=B��>�����Ȳ�h$��vM�-y��nu����Ȓ�h���6M�+y��^u����Fȯb8�j�®���XT�����5�J�`�=Ssi!�.:y�΢�5��`�]S�/U�Fz��=? ���8l�kj��Ɇd������<٠[lp��Ȓ'R�����W�d�^u����!�u�V;�5�u�j`�3Mu��*��<Ssi!�.:yâ�ɆUU����_,���4�/�#�����q�H�e�i4�U�F��얜FC�:�H�e�i4R��F��앜FC�:�H�T"�Ma�cI�T�a,����Le��*�Hϔ]ZȮ�N�7�(>�ƪ*�Hה�EU����y.}>�l�k��6$���tM�-����F��(K`C�:�HӔ�ؠWl�k*��V;�tMeƢ�H�T�`*����L٥���dWgQVU�F��_,����L�g�����jK��)�2ؐ�6�5E�6�V뚒,���`cMS�J`�^u���)G�GX�X�5�u�j`c=S^���
6�3E��뢓]�E1lXU�b|��
6�3��B�v6�5��B��6�5��B�[l�k���Ul�i��6�:�X�4�V;�uMñк
I�&=�&+��do���hlS��[�O���
6�5�B[|�$k$�=��ߎ�F��i�Fd��Ѯiڳ1�:�h�4�و�6�4M{6�U횦=��ڱ�k��lt6��g��lt6��g�l̦&��6MӞ��j`sծiֳ��*I���0z}���$˞lHV��tM�-y�A�*�\�k���ɆTU��JӔ��'����U��!�u�v;�����0U��*=SY���6W陲K�U�I�TD���`#]S�/U�Ff�^����ߎ�Ff��,y�AY%l�kjn������"��lPUl��W�d�^u����F�K�ݎ���:�E5������TR���Zg����æ���'QU���_,����L�[>����q��LS�eO6$����5e�����`#sMQ�<ِ�62Ք��'����L5���c��ڱd����XT�i*k0�T��*��K�u��[�O6����L5��bQll�i:���o�ac3M�I�&���tM�-�m~R�U��(K�F��y��){%w��O�J�T"����'u^�k*�0��Fz��SIl�g�.-d�E'�8��:]U�r|��
6�3=��R�1^�Zהd鈁�R�պ�薍/u^�kJ�l��t��jMS��F��:��5����R�պ��cQl�g�k0�T��z���Bv]t6Kc��ɪ*�X��EU����v���o6�ߎ���"�N���6�55��4�����"KN���6�45��4z����!�h�����cQl�g�k0�T�{���Bv]tr��E�i4VU���_,���L�����H���ǡC��O�<�����G� @�� D�O� D��u0�&�G� H��D�������>G[�p�M��n��5��~��5�"���T?���i)�᳸������uW?ƺ$���W_�\8�v��ܰ�*���/�r���%OL�vXE�<1͟r��y%OL�vX5B���/�r����XT#��L%U������]���Y8�&�*�`���EU���j�z��㰱Y���9�U�;��|����*��[���9l��W�-�/����F�����9��:�E5������TR쯚K�u�ɗ�����j`s����j`s������k���k7밒,=x0~���:��<�s�fV�e��\�Y�����w�ݬ������;�n�a�u�*`s��*��TR���Wѥ����ʢ�����k7�b|��
66+���G���8llV*ɲ#�$����Ke��H5���F楢,9RM�:�ȴT�J�T�WldZ�D��r9�nǒS�cQldV���TR���.-dWE��ix�G�YU����Ţ*�Ȭ���d���+��>�l�Ên���O6�a%Yv�����5X�+��s���:��\9�dcV^���6�_�5�J�`c�Uti!�*������dê*�X��EU�����\x����tXQ��FY%l���n�k4r���tXQ��FUl���^�k4򪃍tX%By�V;�tXeƢ�HU�`*����W٥�����:���h����tX9�XT�n�7��i����7찊,;�F�J�`��ܒ�h�V찊,9�F�:�`�ռ��h�U�j�|��#�v,��:�E5������TR쯚K�u���Fŧ�XU�Z|��
6�_���l^����J%Yzm����KE��4��7��J��4��7���^�i��o66-�#�M��ll^*��XT���k0�T��椢K�u���������`c�R1�XT�>��<����pV�Ȳ'�U�祚[�d�nu��y�"K�lHU��j^ɓz����j���1GX�X8/U�a,���J�5�J�`�sRͥ����-��'VU���Z|��
68+u{s1��9뚒,��*ac]StK`�nu���)�ؐ�6�4E�6�U�r��aq�Վe]S^���6�3�5�J�`c=Sti!�.:��YÆUU���)���`c�Ro|��/��Yהd���>o�5E�lt���7뚒,]0}��͚�蕍.���f]S�P�����f]S^���6�3�5�J�`c=Sti!�.:�ѱp�'��`c]S�/����������?���O�6+�dٓ��`s`��ܒ't��́]S�%O6���́MS�J�lЫ
6vM5B��#lv����cQl��L%5�9�gj.-d�E'oaX?ٰ�6vM-�XT���l��O6��J%Yz@`��搮)�eƟl隢,; 0�dsHӔ���O6�tM%B��<�dsH�T�a,����Le��*�Hϔ]ZȮ�N��"J�?����.��l�gz>N�=�O��5]8�F�J�h�t�4���F���i4R��F����Ы6�5]8��v;�uM��h�
I�3�O��
,$i�4?��6U�i�t    �4��`s]�٥�9|����=[��㰱�)��'��Q�uM�-{�QpXהdٓ��h�Ú��=ٌ�$8�k��_����:�E5���)��TR뙢K�U�YӔEɓ����ú�_,���L/�)&!l�~;욊,���*a�]Ss�`cnu�����"؈�6�45�6�U�j��ai�Վ�]S]���6�3�5�J�`�=Ssi!�.:��U�FUU�������`�=��?tY��e6�5Y
�U��������`�]S�e�Ul�ij^lȫ6�5�e������cQl�g�k0�T�{���Bv]t���(���`�]S�/U�Fz��g��5��y{6�5Yv�3�*a�]SsKn}F�:�`�TdɭϤ��6M�+����`�]S��o�����cQl�g�k0�T�{���Bv]tr�:��[�YU�Z|��
6�3�/�ލ���q�`�Td�7�U����|�A�:�`�Td�7R�����|�A�:�`�T#���a�ca�T�a,���Lu��*�`��\ZȮ�N���(�fê*�`���EU����p��6~��a3MI��lHV	욚[ҳA�:�`�TdIφTu����y%=���vM5B�jp�Վ�]S]���6�3�5�J�`�=Ssi!�.:�#�(�ٰ�
6�5��bQl�g��g�ưyϏ��)]S�%�AYlN隲[v���)]S�ŰAUlNi��W����)]S�7,��ٱN��:�E�9�g*k0���攞)���]��"
a#�؜�5��bQlN����ߎ���"˞lHV	욚[�d�nu����Ȓ'R�����<٠Wl�k��_�a�ca�T�a,���Lu��*�`��\ZȮ�N�°(~�aUl�kj�Ţ*�찫o���_����8l�kj�6&��uM�-��������&`c�:�P�T�بWl�k��ܰ<�jǢ����XT��L%U�������]5M]�Oظ�
6�5��bQl��3M��|�v6:�4�f#�J�X�41`nu���i:b@Tu���i<b���`c]�xĀF��Xv�@��FWa#�nȾ��
,$Y�41`6U�Y�41��*�X�41`�U��|������4EYv�y�����}��A�Į�Ȓ���7��45�����'vM5B>>;���]S]���6�3�5�J�`�=Ssi!�*:l��(>�<���]S�/U��G�������c{^�{r�����8p~�M?J�����J���~v�;v>�ց�G����������Ϗ��gϾ��g�~�O��m�qV;ُ��炰D?:�X���
F?z���Zʱ�����a�%e�~tR?G� ��vR�<ơ��T�����H�K5��r���RE��6 �:a+ռ��ȫB�K����V;�RuƢ�`'U�`*�vRͥ����%���
8�K��bQl����������o�a��T�e�!Y%l��jn	lЭ6�KYR��[�����`��T��7,��ڱ����0��;��SIl��j.-d�E'�:�bذ�
6�K��bQl��z<��<�a��T�e�wHV	���n��t����@EY�}�Tu��	��|�A�:��T���p�Վ%3PeƢ���SY���
62��]ZȮ�N���(��ê*��T�/U���^�]���6��d��5���掽TsKN��[l��KYrr�TU��c+ռ��k�U�;�R5B>��6;�{��cQl��I�5�Jj`s�N����]���dQ|r�U5��c/��E5��c'�=�`����=jw쥊,�}3~��]g�.ܣ�nu����=j����N@]�G��`�P�Q��Kg�����*l$�D��5^��$���ߣ�6u��4��{�XU��ߣ��5�l��e[x���a���� K�l@V	���nٓ����f��,{�Ull*zeO6�U����_�a�c�T^���66���`*����>E��뢳�0(J�lPU����Ţ*������_��G�L��*o�I�}�!Y%l���n�7t����RQ�|�!Ul���^�7�����R%B~��V;��ReƢ�H'U�`*���tR٥��褕*�����`#�T�/U�;����H9�;쥊,�G�d���^��%���[l��*��5R��[��ܣ�^u��^�F�wqq�ݎ%7��:�E5��N���TR줚K�U�a+UE�=j����R-�XT�^����w����_���A�$���I^	����= �G�:�l�O� D��u0�	�� }���MJ�����s��$��n��5������슴
V4;��k��V�����~�볺
^4Q�c�K�*��\��}_T�-�:^�c�Udٷ �UBKf��[�-��`%�UQ�|"U�d�*{%߂ЫN2YU"��	a���lUY���F2WU�`*����Te��뢓/�,����
:2Y��EU�����}�2���e�w��������e�w���n�)���@�6[�d�)���@�6Y��Sn㗁�m�*G('��/��lU^���66W��`*����TE��뢳s�����
66Y�EU������,��0O��檒,�yz�,z�+�e7O��E��aEYv��tY�.V��n�/�ޥ�*����eѻtXeƢ�HU�`*����W٥�������,*�*�H���EU�����wv���~:�e�$�㷠�#��i��ާoA�G��m�$�ӷ��#�j�~��ӷ����~���w��#��~^�K�
H=���yͮHk`����G�3�"���6<��Y]�ub?ƺ$���Cz��-bz�����n,ʒ'&��A�!�Xv���حVҍEY�Ą�:HI3���'&����tc%B��["�v0���:�E50�^���TR!�ŲK�u����OL����tc9�XT�������㰑n,ʲ^�*a��Y{tKzA�V�Ƣ,���6Ҍe���^u��n�D����ڱ�+�0��Fz��SIl��.-d�E'�)Ž VU�F��_,���b��m�你�a��X�e� �U��*g��-��[l�+��D�:�`3ּ�^z����!wK8�j��n���XT���L%U��^����]���X��XU��Z|��
6ԋ���e�`��㰡n��"ؘ�6ԍU� 6�V�ƚ,����`C�X�
`�^u��n�G�s�������cQl��k0�T��z���BvUtԌuQ?a�*�P7V�EU��y����:�x��a�ZI��F#Y%l��n�k4t��uaM��F#Ul��^�k4���u_=B~�v;����u�j`C=W_���
6�oU�����f����h���uZ5�XT걾����	�_��uXM�<٠�6�aU��Ɇ��`CV��O6���5X�+~�a�:�P��#Ŀ�%�n���eƢ�P��`*���Wե�������FTU������`c���5گߎ��:��k4�U��:��k4u���uX��h����5X��h�U밦��<�jǲk��Wa#�n��^��
l$�-��k4�����_���
6�a�^�i|��������c{^n��=�����8p~�X?J�����J���~v�;v>�ց�G����������ϏF�gϾ��g�~�Z��m�qV;ُn��炰D?��X���
F?����Zʱ�����a�%e�~t]?G� �v]߷���w�~;%��*��F���;8��ܲ�����V�e7ZO�yR�U���ǿ�<qb�F(�"��y��V]���>O�תk0�Ԁ牳Zͥ����>�����j��ĉ�_,�����ޒg�߿]����ۿd���e��H��D��}�%���-�M"�f��,y�F�6�(yc�^�+7��aɒ�6!���uǊd�{^��(�M$I���L%)l"I�&]ZȮ�N�ó(~�ƪ6�����_�a|�$�x�~���m�,�x�~6�U��f��[v���m�,�#8���Tu������<�v�@$��	^���#�v,����0�����L%U��Y���Bv]tv����l����Ml��bQl���z��ґ�_����RI��F#Y%l���n�k4t���U���,y�F�:�X+�    ��h�U�r��*�#�v,��:�E5��N*��TR뤢K�u�ɻuů�XU�b|��
62��<f�kW�D��ou�eO6$���l5�����`�3[E�<ِ�68�ռ�'���Nl���c��ڱpf���XT�תk0�T�g��K�u��[�O6���Nl��bQll^�~����8ll^+��'��o6�K5���f���RE�=ٌ��V�yeO6��l����_���l����0��;��SIl��j.-dWE��T%O6��l��j�Ţ*�H'�����}�v6�K5Y:�m��H��jJ�Q3�:��lU�eܖ�Q�D���5󪃍MV�e��=j�,���ݣ����d��{�t�l�*���]�MUeQ2�m��H���.�V�Q�$ɮ~.8�X/�dlHV	륢[t����RI���Tu��V*z%�A�:�X/�#��#�v,��yƢ�X'��`*���uRѥ��謕ʢ6�����R1�XT�޷|4��㰑��(Kg߬���d��|45���Ff��,�}�4�:e�7����U��*�����ԉ,��*�0��F��L%U������Bv]t6M)M-�*��dU�/U�F�ׅ�7��2We٥�$��vM�-����`�]S�%�v��6�45���N����{X�J�|�#GX�X����cQ�>l^���G^���6/Ir�/���]���ˢ��NVU��%kag�K;1�J�M�^8�����v��)ɲ�h$���K���A��5����%K���,y�F��lk��W���`c]S��_�p�Վe]S^���6�3�5�J�`c=Sti!�.:y�΢�5��`c]S�/U�Fz�Ǚx�v6�5EY:�`���K��О`�:��T�e���D�-������M@��J��/Y6#=  ���d�7��I6w#> �6u��܍�����`cP1�XT�>����y��F柢,{�!Y%l�kjnɓ�����"K�lHUl��W�d�^u�����!�u�V;vMuƢ�`�T�`*���Lͥ����-��'VU���_,����LS�|�v66��di�f6�55��g3욊,�ٌ�����l�a�]S�P�������XT��L%U�������]���Rب�
6�5��bQl�gz��E��ߎ���"�^���66ݒ�h�V��J��5��`cP�+y��^u��	�!�����f��:�E5�����SIll�)���]��[gQ��UU��	�_,����?�_��ߎ�F��(ˎ>��6�5e���3���F��(K�>��6�4e���3z��F��!���K���cQl�g*k0�T�Fz���BvUt�4Q|��UU���)���`c=�c��c���uMI�ލ6@����ݍ6@���$��F? `MS���F�? `]S�P�ך? `]S^���6�3�5�J�`c=Sti!�*:k��(�m���uM1�XT왾��,܍�8�3�%o֣y�d������%�l'yF���z2��6�45�����H��a��w~��۱�{0���*,$a�T�`*���Lͥ���i�������H�����l�&uF��L:b��㰑�)���h�#^��L:b���`#]S�e�цG�D�[�tĀy��F������1�m�5�u�*`�I�T�`*���&=Svi!�.:{���PUl6�r|��6��Lυ��o6�tMQ��lƿ�l�5e��g3��f��)ʲ���7�M����lƿ�l�5���1��f�����XT��L%U���)���]���n`Ul�k��Ţ*�`��r��ӻѾ~;욊,���*a�]Ss�`cnu�����"؈�6�45�6�U��vu�6,��ڱ�k��0��{��SIl�gj.-d�EG���ب�
6�5��bQll�����l�k��d��J�X�t�Ɇ��`c]���Uu����{��ƺ�O6a�c]������'��O6�Iv�z~]����5M�lDU��O6_%I��>�'��ߎ�ƺ�$���6�5E�� ���ƺ�$K��6�4E�� z��ƺ�!d��˺��cQl�g�k0�T��z���Bv]tr�E�VU�ƺ�_,����4}���o�ac3MI�^W3~m��)�e�Ռ�Fۤk��캚��h�4M�+��f�4�&]S�P�<?��I�T�a,����Le��*�Hϔ]ZȮ����K�����tM9�XT�^��^���tMQ����f��)�e#Ư�٤k��l���u5�4M�+10~]�&]S�P����f�����XT��L%U���)���]�����FUl�k��Ţ*�H����:_���tMQ��fzR�K�����Nv���tMQ��fxR�K�����N����tM%Bٰ�'u�d�ΞN�U�H��=��)+��d�z<��m�������LO�|�Z��6��:_�dW?`s��Ff��,��*a#sM�-����F暢,���`#SM�+�z��F��J��aq�ݎ%;;��XT�i*k0�T�F晲K�U��DSŰaUld�)���`#3M�[^�|�v6�5EY�U��暢[t����5%YR��Ʀ��W����M5�y���Kvv^���6��Le����6�]ZȮ�n���,�aê��6��E5�ٱg���|�O��4lv욊,;�F�:���55��4�U�fǮ�Ȓ�h���͎MS�JN��Wlv�j�|��#�v,��:�E5������TR왚K�u���Fŧ�XU�Z|��
6�3}=�^�y6�~;Ꚛ,���*aC]Su`�nu�����ؘ�6�4U� 6�U�z�?7,��ڱv��}Ƣ�P���`*���Lե���`WwQ?a�*�P�T�EU����{��-~�y�v6�5Y�d��J�`����'v��vME?٠�6�45��Ɇ��`�]S��:�����cQl�����TR왚K�u��[�O6���vM-�XT�������4EY�͆d������%�lЭ6�5Y�͆Tu����y%�lЫ6�5���?GX�X�5�u�j`�=S]���
6�35��뢓/�,��ٰ�
6�5��bQl�g�?�����4]x�AY%l�kjn��O6�5Yv����6M�+�A`��������l�k��0��{��SIl�gj.-d�Eg7�O6���vM-�XT�^��j�~;隢,�A�d����)�%7�[l�k���R��F���� �^u����D�-t��ڱ�k*�0��Fz��SIl�g�.-d�E'7�(�A�UU���)���`#=�s[��6隢,��*acsM�-�����暒,���`cSM�+�z��Ʀ�r��aq�ՎesMyƢ��LS^���
66�]ZȮ�NvuŰaUll�)���`c=�3���㰱�)��y6󰱮)�e�l�ac]S�e�l�acMS������ƺ���D���uMyƢ�Xϔ�`*����Lѥ���iʢd��<l�k��Ţ*�h�t��y��:w뚒,�A`�Թ[�ݲ�K��uMI�� 0]�ܭi�^���ݺ�����K��uMyƢ�Xϔ�`*����z���BvMtWk��(�A`��y��)��j`s���y�q�~;���4EY��du���\SvK^��[l�2�e�k4RU��*SM�+y��^U���TS��_�p�ݎ%�bxƢ
�\e����TR�g�.-dWE'ME�FcUld�)���`C=�w����K���8l�kJ���I�J�X�ݒR'���ƺ�$KJ�����5M�+)u�Wl�k�r1�#�v,��:�E5�٥g�k0�T��z���Bv]t�4eQ\�dUl�k��Ţ*��L��#�3��������Ȳ�h$����5e��5���F暢,y�F�:��TS�J^��Wld��Dȯb8�jǒ���cQld����TR���]G��뢓w�,�_���
62Ք�EU�����#����8l�k�OCY%l�k�Oc�:�h�4���:�h�4��^u�Ѯi><M"�v,횦��d6��g�O��H��i<<�mꢳ�i><MTU�Ѯi:<��$�v��Nc���~�v6�?e=rYڳ�{    ��[�s�-��̽F���w�4�e=���h�Em^Y�f�5�oY�J��՘{��[�ueƢ����t[Y���6�%.-d�Ew������k�߲vv��L�F�-�w���?ټ~;��wu�%�AY%lN���-������}e1lPU��wu��a�^u�9yW�qÒ���]�a,����;���TR���uvi!�.:��E�FTU�9vv��WI����K�d�ڂ�as���I�=ِ�6w�kݒ't���]�Z'Y�dC�:���ou�J�lЫ6w�{�#俎9�jǺ���cQl��;��TR�����.-d�E'oaX?ٰ�
6�����l0�F�Cv�#�y�v6��I�}��yȮ�n����'����$ˎ>�?�<dWG�������Cvu�P���?�<dg�u�j`󐝝�`*���C�uti!�.:��Y�}��y.��r�y���I��v��R�|�v6O��E�]�I�J�<iW7��"Nt��͓�u�%q��6O���+����`�]]#��9�j�z�ή�0���I;���TR�'����BvMt���*�/�dUln����/���*I���q.�8�F�����,��fn��oY��:�e��̍�-��ZGYv]�؈�ߢ�ou�ʮ��1�[��.ʕ's#~���eƢ
��.����TR�����K�U�m�FD�u5s#~�Z��庚��%}������?��rI&���پ��.�i\T	����������T�����S�5u�پ��|�Θ>u�پ�����K}
�ۥ����^*����}/���BA\������Ԫ���{�'I�\S�=���TR��]�*��Ӽ~;�]�*'Y�C�J���w9�%�0�V�]�.'Y�C�:���W9z%�0�U�]�2���`��ڭ���9��XT���m�k0�Ta�*��K�u�����0��B�uag�g���dg�nA����j��nA#Y%l�vJ}�4t�����G�-h������G���Wln�>Z��#�v�����[�x6��{߂�+��d���4���ΚG����
6���]5Ӱ�ɮ�����8l�U��Y%l�U��4�:�X�4��)�:�X�4��i^u��Vi<�S#�v,k��39u6�dggr�
l$ɾ���4���dW�gr��
6�*grZ|�$>�r}�w|�v6�*Yr�e���V�����ح6�*Y|�Uu��N�y���ث6�*���DX�X�*�u�j`��R]���
6�(5���㓌"
ϝ��
6�*��bQl�Q�]n�������V�ȲC�$���J�-9�nu��V�ȒCΤ��vJ�+9�^u��V�F�e9�j��V���XTl��L%U��F����]��OgQ|șUU��V����`#��������8l�U���b�U�FZ��\L�nu��V)ʒ�iHU锲Wr1z��FZ�!_n�V;��JeƢ�H�T�`*���4J٥�����Ӱ�
6�*��bQl�Qz�5�ߎ�[�"˾ِ�6�*5�����[�"K�ِ�6�)5��z��[�!����[��cQl�Q�k0�T����Bv]t�ŔE�7V����V���j`sX�tKa���i��*Y��du�9�Ujn�ŝ[�#Kvc�5I�`<�	����4���8�乭�K�ń'<�LeQ�p����[�ѐ��lvL�
,9F#T���)5�����f�T�J�G1,a�b�*�:�Af�c�Tk0�Ԙ͎�Rci@�J:̔*(>FcT��`���AUfc��k~���v��|�J�����*��#W��-�� [��|$K��������#Y��+�� W��|�K�J�Y��[�$��u�j��#]��SH��|�K��4�]%�*y$�9FU��G���|1��l>R�m��	�	�5EXv�6��.YSfK����%k���m�0�]��̕��&�K�T$䣘��vɚJƠ�����`
�2ə2K�U�I�T@�1��a�u`e�c���və�m�ln��Ʋ�K�`�fcYSd�̆���Ʋ���PufcIS��̆���Ʋ�,�,X(a�bY֔�0՘��L�SH��X�YЮ��Vu%f��*���)����s��e�������`�T`ٝ�*���Ɩ�� [��`�T`ɝ�����ƕ�� W��`�T%�s��Z�0k�u�j�s�Z�)��l0gj,h�I'7���lUe6�55�bP��`���ŭϯo���dM������]��̖�����]��K�fz��.IS�J�f~��.YS�����ϻdM�cP��H�Tj0�T���L���:�dU�[�Ue6�5e�bP�����}M_x};�ldz)²�U��L0e��A ���F&�",i T����R�J���ld~�Hȗ�,a�b�S��Tc62�Tj0�T��L.e��뤓N���2�_��Š*����m`gs����������*���Ɩ�l���l0k*�dgC�:����q%;�3̚����%�V,̚jƠ�����`
�2̙K�u��)�������&_�2̙>��3��
�l�����2�!X���SdK�����&�,1Bՙ��/E��l���ll~)K�KX�X6���0՘�M/�L!Ufc�K���:�dUgPl6��2�_��Š�90g�<�0���h�eM�c4�ՙ�aY���ت�氬iz�&�*�9,i�W���5���T�f�:,k�i6���46���h��L�c4����nL�f�1�aY���� ����.��l~��n6�55Xd6�4ʚ*[`6�Vg6�55X`6��3J�*W`6�Ug6�5u	?,��Z�(k�u�j̆r�^�)��l(g�,hWIGIS�i6��2�u`e�4���d��,��,����K��X��`��ز�j���l0k*��@ՙ&M�+{�������*�<y�v+���u�j�s�Z�)��l0gj,hWI�IS%�� ��l0kj�Š*����{� ��v��`�T`�<�U�fM�-�g�luf�YS�%�lUg6�45�d�rՙfMUB���v+�LJ�:�A5f�9S��Re6�35����ä���y6��2̚�|1��l,g��o�=�*g���4%X���|����Ȗ��<�ll�)��W����M5E�����fcSMYBy9x���\S��Tc66Ӕk0�T���3E��뤳7���Ue66��AUfC9��������I��O7ʜ~�G��^i>�=���W�:��7x`D��ufDIԯ܁!}�3%ʤ~��sq�.m��Q6�{��kL���kvZeV�S��ڠ������}�wt�yQv���C�*����r������t�������*M3��혌�ά0�*�h�$�:���qE;&�3'̰���[%�V0̰jƠ3����`
�2!̯K�u��鎂����L3�&_�2ɯ�q�����f�V�e@�@��K����ll^j�x �:��i�q�qՙ�MK�T�jŲy�a�VaIf���Z�$���6M�t2)5n<PT��ش԰��� Q��yY����Ϸ�͆2�[�Vi6�aU������̆2��Z�Ug6�`U���ڸ�̆2�.!�媄ՊEV��Tc6�_�L!UfC�Uei@�N:�WP�R��*�������Ff���|g���O6�3���\#X�ٜ�a5���5d�2�3�K�\#T�ٜ�`5���5�2�3�*!���6+։V��Ta6'�W�SH�ٜ�_5��뤓�!��ƨ�91�j�Š�91���B������f��R����ld^*�%�h�Vg62/a�1���F��2Wr��\uf#�REB>�a	�K�JƠ��Y�R�)��ldN*�4�]'���3(>FcT��ȴT�/U�������]�g.uٷ�n�����c�
��r�B+M�#����w���Zg<y֯�ޭ�+��|>��9{���u��k���o��/�V��l�/�s XcD��_�f�2��|�w��t�d�H���9��2����w)�U�$Y�}��g{L�mJWNE!,	�"�Ґ$��lq�����H������3"I�2W,e�:���H��D��[�8�*u�j�G��R�)��x$��,hWI'iW��RAU��]Y�Te6�u�\    �G:-���t������6i�U��]�-i�F�:������6iBՙ�]�+i�F�:����Jȭ�,a�bI�;�a�1̺j��*�����4�]%�]�I3��l0�j�Š*�����Jw6�o���UXj6�w68[��2�����٪��f��'�Wf6�w68YU%�k��g�jƠ����Z�)��lp���4�]'�����FQUf��UM�Te66W56�׷�����f#�J��\��%�����\����@��R�+y���RUB~P���R�cP��`&Uk0�T�fR���:����lUe6�K5�bP��`&��\ڹ��v��`.U`�c��;�d�*�e����\�٪��޹&�U�+{t~�LV	�A���k2[U�0՘��U�L!Uf#3U���:���sMQUf#�UY�Te6�I=������f�sU�=J�J��٪Ɩ<�luf��U�<J�:��ɪƕ<�\uf��UUB~P�%�V,���u�j��j��*�����Ҁv�t�B0���@Ue68Y��AUf�sU�˾��h�o����R	�@	Vg67˥"[ E�*��Y.�`I �PUfs�T*r%P�2���RYB��͊u�\*�a�0��eR�SH���,��,h�I'�T�PF՘��r�(_�1�fR/����>�ln�KX� @�J��\��%�Vg6�KX� @�:��T�q%�Ug6�KU	���%�V,̥jƠ��L��`
�2̤K�u�I'��FU��RM�Te6�I].�%���v�٬һN�,gC�J��٪̖�l���ld�*����F&�2W��A�:��ɪ"!g5X�jŒ٪R�1��ld���`
�2���,h�I'y$�9FU��LVe�bP���\��Ȼ��2�ll�*��n4�U��U�a�-�FC�:���)n4Bՙ�$M�+�FC�:����H�M,a�bI�T�0՘��L�SH��HΔYЮ�N�����Ue6�5e�bP��H�t���u���\U�efC�J�����%f�luf�YS�%fC�:����q%f�\uf�YS��,��[�de�:�A5f�9S��Re6�35����ä��b�aT��`���AUfC9���n:h����fCYS���Vi6�5U�h��ՙeM�#T��P�T��q�Ug6�5u	�I{��[�h���a�1ʙz��*�����4�]%%M�#PT��P�T�AUf�9��r\�n�c�H�fM��>�E}ì��%���GP�0k*���y���&M�+i}�?r��YS���g珚�a�T�0՘�L�SH��`��XЮ�N���>�%}ì�����s��e_�������f�YS�e���4���lI�3�ՙ��@EX��L�:��	�̕�>#W���T���gY�jŒ�R�1��ld���`
�2�}�,h�I']��[�Ue62��AUf�9��8��o��fM���6���Ɩ��6�����F�~��IS���F���YS�P�ך��YS��Tc6�3�L!Uf�9Sci@�N:{�1}A@QUf�YS�/U��L�˖���|;�l0k*��A���`��ؒ��w6w̚
,i�~gsǤ�q%��l�5U	��y�����Z�1��l�3�L!5fsǜ��4�]'�t¤w6��1�;fMM�Tc6wʙ>gog� ��v���)kj��A@`ufs����E�Vg6�55X�  �:����rE�Ug6�5u	y�=KX�X�5�:�A5fC9S��Re6�3U��뤣N��2ʚ�|1��l0g�/���%k�/���בT�����]���Ҝ�]�����]�����]����]r���]r��Ҝ�]�����]����s��e?/y��y�n6�5X� @�J�����%�Vg6W�7%X� @�:����q%�Ug6�5U	���%�V,̚jƠ�����`
�2̙K�u�I'��FU�fMM�Te6�3}��30<���|Ǭ��ҷѦ�>�m�)�eo�Mo}��\S�eo��n}��TS���F���|���,���5���nsM�cP���LS��Re66�YЮ��&�2(ymz��ݦ��|1��l$g�/��Ϸ��g�
,{�`�f�sM�-y����
,y�Puf�SM�+y�������2�~���5�:�A5f�3M�SH���<Sci@�J:�h���m4FU�N55�bP���L��r�l��9��dM��!��l$k�l�1�ՙ�dM�!��l$i�\�1sՙ�dMEB<�	���b�cP��H�Tj0�T���L���*�$i*��MPUf#YS�/U���4���6Ӕ`Y� �*�F�2[� �luf#sM�4��ld�)s%�Ug62�T$�Kf��Z�d���a�1�i*5�B��F�2K�u�I'��FU��L5e�bP��|�L����ߟm��[�"�O_O7����Wh��Zi:��﬽��w�:��ȝ~��n=_�u��<��ٻ�|�3����/�|[�~!g��}dPQ��#�Ƞ��6sX�}�P��5�c'����`��ʔ>2�ߥ VfRx��;�o����R	��ViH�KE�d�lufd�T�%� B�ѓ��d�\5&�%��YB�%�+�����:�A���<o�Gj0�T����G��뤓Ż FU����λ ���$���Z{|;�l�dU'Xf6�2��YVudK��j�f��T�%fC�:��	�ƕ�rՙN@U	y�b	�g�jƠ����Z�)��lp���4�]'����͆QUf�PM�Te68�t���~���t��\����	Vi6�K5��hd�3�U��%X�B4���S�ƕ��\uf��T��_f	�s�Z�1��l0��5�B��3��Ҁv�t�>;���Ue6�K5�bP��`&�ُ�v����n6�KX�əݹ��e}�i皱ՙ�R�er&w�=@Y~)�\3�:��\�J(��ٝkX�`�:״
H�^�:״H�\
;׌�N:�.��k��2̥�|1��l,�������t��\���������%���)[��`.U`�k��Q{����wԔ��l0��rb}�;jX��@���WaI^��Q�
l �k�;jJS'��6����*��\�����3��~�} ��O7̥
,�� ��l0�jlY&����s��29��3L�W��!�:��\�J(���Z�0��u�j�3�Z�)��l0�j,hWI��T%�DU��RM�Te6�I}���w6�o����R��lVi6�Ke�dg�luf#�T�%;Bՙ��R�+�� W��H.U$�_�,a�b�ov��Tc6�I�L!Uf#�Tfi@�J:I�
(��0��l$���Š*��L�r�.�h���h�K%X֍F�J��\*�%�h�Vg6�K%XҍF�:��T*r%�h�Ug6�Ke	���%�V,�s�:�A5fc�T��Re6�IE�����T*��n4FU���RQ�Te62��8oy7ڣ~g���?EX֍F�J���Ɩt�![���T�%�h��3��j\I7rՙN@U	���%�V,���u�j��j��*��٧�Ҁv�t��Ƞ��QUf�PM�Te64��9dg�����fCYS�e��Vi6�5U�d��ՙeM�Z#T��P�T��Ak�Ue6eM]B��6+�BYS��Ta6�L�SH��,�3U��뤓y��1��lʚ�|1��lʙ>���57����d�Y(kj��lVg6��@E��l���l��J��lUe6�M@E��l���ll*K�KX�X6��0՘��?�L!Ufc�O���:�dUgPl6��2����Š*�����*�}��v��H�aY� �*�F��̖4 [��H�aI� ���f�{S�J���l$k*�%3KX�X�5�:�A5f#9S��Re6�3e��뤓N���2ɚ�|1��l,g��9�Ƿ������lVi62�ْ;d�3�����ΆPuf#P�+��A�:���	;K���,a�b�T��Tc62�Tj0�T���>e��뤓S�w6��2����Š*����Ƕ�f����F���̆`�f#YSfK����F��K̆Puf#IS�J����F��"!/X,a�bI�T�0՘��L�SH��HΔYЮ�NVu�fè*���)���̆r���K���v��P    ��`ٝ�*͆��ʖ�� [��P��`ɝ��̆��ʕ�� W��P��%�s��Z�(k�u�j̆r�^�)��l(g�,h�I'7���lUe6�5U�bP��P��9�`C�?�N7ʚ,4�U�eM�-2c�3ʚ,2Aՙ%M�+2�3ʚ���`��ՊEYS��Tc6�3�L!UfC9Sei@�J:J�:(0EU�eMU�Te6�3=�y6�o����?EXv�6}�������l���l0k*��m�<���ƕ�͟g�`�T%䣘��l̚jƠ�����`
�2̙K�U�a�TA�1��y6fMM�Te6�3�/��Ƿ��F�",yA a�f�YSc�_`�:������Ug6�45���3̚���B	��_�:�A5f�9S��Re6�35����ä���Ue6�55�bP��P��y^����?�N7˚,��!X��X�ْ;d�3˚,��!T��X���;�3˚��|��6+�jYS��Ta6��L�SH�٬�3E��뤓S�w6��1�ղ�(_�1�g�>��_}~|;�lV�i*�t�����[6b`z���sM���� ��TS��FLoXq��J(��OoXq���a�1�i�5�B���K�u��,���gAU�N55�bP���L�������o��fM�O�����YScˆ�MA`Ŭ����i�_X1ij\���/<��PpMA`Ŭ��a�1̙j��*�����4�]'�ͽ_pT��`���AUfc3M���Ƿ��Ʋ�K����5E��A`�1�jYS�e���VK�"W� 0�m��)K(���Ѯ���  U�@�n�����u��/0M�t�	��  �*���)����s���zO����t�������U�fM�-n`�:������Dՙ&M�+n`�:����J���"a�ba�T�0՘�L�SH��`��XЮ��;a6��l0kj�Š*����yI��^�N7�i��lR'�*���"[2������,��I�:����ȕL�D�:����,!O{d	���rƠ����\�)��ll�)�4�]'�L4eP<��QUfcSMQ�Te62��8��9�?W��LS���hӟ�Ye�)�e�hӟ�Ye�)²c���լ2Ք��c���լ2�T$�����լ2�T�0՘��4�L!Uf#�L���:��l}�FU��L5e�bP��`��vy�d����v��P��`a��*͆����>[��P��`Q볠�̆����>W��P��%��Y��Z�(k�u�j̆r�^�)��l(g�,hWIGIS�ϊ�2ʚ�|1��ll��N�|};�ll�)�����4ɚ2[2���F��K�B��l$i�\�Xh�3ɚ��<Z�%�V,�V�u�j�Fr�R�)��l$g�,hWI'IS�c�Ue6�5e�bP��H��z�F��v���LS����F[)k�lY�����Vʚ,k��6�JIS������R��%�K��o���5�:�Afs����`
�1�+�L���鮔4uP� 0�m�+eMU�Tc6Wʙ>=kj6�og��ղ��B��3��eM�-	u"[��\-kJ�$�I�*��Z���P'rU��ղ�,!Y�jŲ�)�a�1˙r��*���)�4�]'�$M�:Ue6�5E�bP��H�����h�o��fM�5��ld�)�%�Vg62�aI� ���F��2W� �\uf#SMEB�df	�k����Tc62�Tj0�T���3e��뤓N���2�j��Š*������l�N7�iJ�lgC�J���)�%;d�3ɚ",����l$i�\�����F��"!�:f	�K��R�1��l��k0�T���L���:���A�ΆQUf#YS�/U���L����6�ll�)��I���F��l���lt�i��!T���TӁ�rՙ�N5�ٰ�Պ�sM�Wa�f��;����3�w6HS'�M4��0��lt�i��A�*H2!iM_}~};�l(kj�lx�*��[2<����
,�F�:����ƕOC�:����*!�b	��jƠ����Z�)��lp���4�]'�̽cP<<�QUf�SMM�Te6�3}�����<��n6�5X��<�l0kjlY��|���������f�IS��Z��fMUBi��o6�5�:�A5f�9S��Re6�35��뤳����AU�fMM�Te6�3ݯ[~gsݦ�eM�����ld�)�%w6�Vg62�aɝ���F��2Wrg�\uf#SMEB>�g	�K�JƠ����R�)��ld�)�4�]'�ܘ2(��aT���TS�/U��4}��y�w6Úm6�5%X��!X��X�ْ��ՙ�eM	��lUg6�4E�dg�\ufcYS����ՊeYS��Tc6�3�L!Ufc9Sdi@�J:K�2(��0��l,k��Š*����z9nK� �0��f�YS�e�4̚[� �luf�YS�%��3L�W� �\uf�YS��/�Y�nŒ���Tc6�3�L!5f�a��XЮ�nä���F՘͆YS�/՘͆9��*~A���l��,k�  �:��,k� `lUf�Y�4}A@PUf�Y�4~A����f��i���JحXr� �UX@��i���V`IN����J:K��/(��l,k� `�U��fM_}~};�l0k*���`�f�YScK�ѐ��l0k*���Puf�IS�J�ѐ��l0k��QKX�X�5�:�A5f��9�`
�2̙K�u���:��c4FU�fMM�Te6�3�o���fMVi6�5h@�:�Ѭi� @�:�Ѥ�@� rՙ�fMX�j�Ҭi� �U�@��i� ��@��i� �4u�Y�t�A�QUf�YӸA � Ʉ������o�m�5EX6<m��h�dM�-�6�m�M��K��Mm��)s%��濍�I�T$�\��F�$k*u�j�Fr�R�)��l$g�,h�I's��FT��H֔�AUfc9�{ڍ��v���LS�e�4�k�lI� �ՙ��5EX� @�:����̕4 W���TS��/�Y�jŒ��R�1��ld���`
�2�g�,h�I'�0�Ue62Ք�AUf�3Ms�y����Fg��f��J����̖���o62�a�X��f#SM�+=�ld��H(��盍�5�:�A5f#3M�SH���<Sfi@�N:�U������F���|1��ld��O{};�l$k���l�O�$k�l�����I�a��L��IҔ���?<m���H����i�dM�cP��H�Tj0�T���L���:�dU���)��l$k��Š*����r�/׸���t���)n4�U��dM�-�Fc�:���)��n4Dՙ�$M�+�Fc�:����H�M"a�bI�T�0՘��L�SH��HΔYЮ���v�	��l$k��Š*����s�w�=��n6�5EXz�6�M��̖���F��)²c���h�4e��m~7�dMEB9��ߍ&YS��Tc6�3�L!Uf#9Sfi@�F�]��J�Ѧw��5e�bP���3=/�ٜ��f��)�R�X���5e��l���lvɚ",3@U��.IS��̆���f���H(JحX��cƠ
��%g*5�Bj�f��)�4�]%�$M�����F��,_J�f�����f�[���MK:a�u��/f��ndK�ѐ-7����,�F#Tn6(�A���r��`I�#K�M,��X,�s�:�A��$�l�)�`
I�&�$��Ҁv�t6єAq7�R��`��܍��U�h��������|;�l(kj�p���*͆���ͳ1�:������y6��3J�*W4�Ƹ�̆��.!�DQ	����^�1��l(g�5�B�̆r��Ҁv�t4!IA�<EU�eMU�Te6�3}ι��h?�N7ʚ,�F�J�����%�Ӑ��l(kj�dx��̆��ʕOC�:����K��X�jŢ���a�1ʙz��*�����4�]'�̽cP<<�QUfCYS�/U��L��v�F��v��P��`�Ά`�f�sM�-�� [���\S�%;BՙN55�dg�\uf�SMUB�u�V+�5�:�A5f�3M�SH���<Sci@�N:9�aP��aT���TS�/U���L�y|g��ߘm6�5EX�6�*�F��̖���luf#YS�%o    ���l$i�\��h�Ug6�5	�}-��Z�$k*u�j�Fr�R�)��l$g�,h�I'�82(~�QUf#YS�/U���L�k������f#YS�e�4ɚ2[� �luf#YS�%��3I�2W� �\uf#YS��/�Y�jŒ���a�1əJ��*���)�4�]'�t�0(n`T��H֔�AUfC9��yݶ�w6�>�l(kj��Ά`�fCYSeK�l���l(kj��ΆPufCIS�J�l���l(k��?KX�X�5�:�A5fC9S��Re6�3U��뤓S�w6��2ʚ�|1��l0g�|� ��<��n6�5%X�\����eM�-{�f��Ʋ�˞������)re�����X֔%�'O��l,k�u�j��r�\�)��l,g�,h�Ig���;A՘�aYS�/՘�a3M����6������ˎ�Vg6�dM�-9FC�*�9$k����PUfsHҔ��c4�2�C��"!Ű�͊uH�T�0U��!9S��Rc6��L���*�$i*���QUf#YS�/U���4����ǆm���LS���� Vi6�5e�lx�ՙ�dM�OT��HҔ���i�Ug6�5	e JحX6��0՘��L�SH��HΔYЮ�n��wJ��!��l$k��Š*����y�����t����K���o62הٲ�j曍�5EX�\�t����̕=W3�ld��H(O��7�k*u�j�Ff�J��*��y��Ҁv�t2�T@�s5�͆��*_�2��MH�G<��n62�a����C�2[6<mz�󐹦ˆ��u2Ք���i�C��L5	e ��P�!sM�cP���LS��Re62ϔYЮ�����#Ue62Ք�AUf�3M�˶�f��v���LS�%#Vi68�����Vg68�T`�DՙN55�x� sՙN5U	�z��Z�p���a�1�i�5�B���K�u��,�#Ue68���AUf#3M�s��l�e��X֔`ٝ�*�Ʋ�Ȗ�� [��X֔`ɝ���ƒ�ȕ�� W��X֔%�s��Z�,k�u�j��r�\�)��l,g�,h�I'7���lUe6�5E�bP��`��98'm}~};�l0k*�tx������ƖO���|`�T`��٭�&M�+�6������J(���>�5�:�A5f�9S��Re6�35��뤳�wi볢����&_�2̙>����9�c���LS��f3�M���h�Vg6:�4>FCT���T������F����h"a�b�\��M���d+{z�&�@�u=>Fc�:�lUϏ�Ue6:�4=Fc�*Hr���;�m~�󐙦��l�:̚[rg3?�y`�T`ɝ��P�IS�J�l�:̚��|�??�y`�T�0՘�L�SH��`��XЮ�NnL����P'fMM�Tc6��L��@7�t�9-kJ��m�ٜ�5E��m�ٜ�5%X֍6�lNK�"W֍6�lN˚����4�lN˚rƠ
�9-g�5�Bj�洜)�4�]'��7��ƨ�9-k��Š*����=��<=t��H�a��L�ٜ6��2����9m�)�2����9m�)ref3=gs�TS�P��9���rƠ����\�)��ll�)�4�]%�M4ePb6�s6�:����L�ٜ�3=�k�\���Ʋ��B��4˚"[�D�:���)��P'���ƒ�ȕ�:���l,k�r0�%�V,ɚrƠ���)�`
�2˙"K�U�YҔAq��QUfcYS�/U���L�[���Ϸ���*��	��lVi6�5E�dg�lufcYS�%;Bՙ�%M�+�� W��X֔%�_�,a�b�ov��Tc6�3�L!Ufc9Sdi@�J:K�2(��0��l,k��Š*����cÚ�l���h�5X����c4̚[����c4̚
,{�y�1&M�+{�y�1fMUBy9x�1fM�cP��`�Tk0�T��L���:������jUe6�55�bP��`���mf�M7ɚ",5�U��dM�-3b�3ɚ",3@ՙ�$M�+3�3ɚ���`��Պ%YS��Tc6�3�L!Uf#9Sfi@�N:[������F��,_�2͙�#���f���4%X������5e����#N�k�����#N�j�\��G�2�T$�����5�:�A5f#3M�SH���<Sfi@�N:{A 1 �*����,_�2�i�?W�|�u���L����U�fM�-=�������B�~��Ĥ�qec��?Wsb�T%���ӟ�91k�u�j�s�Z�)��l0gj,h�Ig����jUe6�55�bP��`���jf����������0�k�l������5EX���o62Ք����0�j*��?`62�T�0՘��4�L!Uf#�L���:��f�lUe62Ք�AUf#3M�s gsNo�Y֔`�Ά`ufs��)�%;d�2��eM	��lUe67K�"W��A�*��Y֔%�_�,a�b�,k�u�*��f9S��Rc67˙"K�u��)���j��fYS�/՘�Mr��>pg�O���I�a�Ά`�fcsM�-�� [���\S�%;Bՙ�M5E�dg�\ufcSMYB�u�V+��5�:�A5fc3M�SH���<Sdi@�N:9�aP��aT���TS�/U��j����j���>�,k��,�J�ѹ��s5�Vg6:�4~�Quf�SM��j���lt�i�\�HX�X:�4}�F���d3M��j�H6�4~��i��Ӊ��s5��2�j�>W��U��fhئ���,kJ���`�fs�3dK�ѐ��l,kJ���PufcIS�J�ѐ��l,k��QKحXr�u�j��r�\�)��l,g�,hWIgIS��h��2˚�|1��l(g��/�-|�����fCYS�Efc�J�����f�lufCYS�fc�:����rf�\ufCYS��s�r	�Vv��Tc6�3�L!UfC9Sei@�J:J�:�O�qT��P�T�AUf#9�ch��7H�a��f~��dM�-���o��)²���I�2W����  YS�P~�o����a�1əJ��*���)�4�]'���40��l$k��Š*����q�8���H�ai7��;ɚ2[֍6��F��˺Ѧ��HҔ��n��w6�5	��i���dM�cP��H�Tj0�T���L���:鬿q`� ���F��,_�2ə�37��9�l,kJ��lVi6�5E��l���l,kJ��lUg6�4E��l���l,k���V+�eM�cP��XΔk0�T���L���:�dUgPl6��2˚�|1��l$gz^������f#YS���h�[�%k�lY7���gɚ",�F���,IS�ʺ��>K�T$�����ϒ5�:�A5f#9S��Re6�3e��뤳�Ƽ�YPUf#YS�/U��L��C{8b����fCYS�e�3�;eM�-i@�*��S��`I� ����NIS�J���l�5u	���%lV�;eM�cP���)g�5�Bj��N9Sei@�N:�aP� ����S�T�A5fsי������w�i:��L�J�ѹ����Vg6:�4o}&T���TӁ�g�3�j:���V+��5�[��
H6�4n}�
l �<Ӽ�iꤳ���ό�2�j�>�|$̙.��O{};�lVZ����*�������ՙfM����������qՙfMUBX�T�j�¬��a�1̙j��*�����4�]'��

�FQUf�YS�/U���L�5����v��H�a�s5�4ɚ2[�\�ՙ�U^�!X�\���F��̕<W�\uf#YS���<a	�K��R�1��l$g*5�B��Fr��Ҁv�t�4P�\���F��,_�2˙�9�uz��n3M	����ld�)�%�h�Vg62�a�1���F��2Wr��\uf#SMEB>�a	�K�b�cP���LS��Re62ϔYЮ�N&�
(>FcT���TS�/U���4���<��n6�5EX��!X��Hْ֔��ՙ�dM��lUg6�4e�dg�\uf#YS����݊%�ٹcP��H�Tj0�T���L���*�$i*�xgè*���)�����r��%��,��fcYS�e;�U��eM�-�� [��X֔`�ΆPufcIS�Jv6�Ug6�5e	��1KX�X�5�:�A5fc9S��Re6�3E��뤓S�;FU��eMQ�Te6�3]�����fcYS���h�s6w˚"[v    �6=gs��)��c��9��%M�+;F����[֔%����9��eM�cP��XΔk0�T���L���:��l=����l,k��Š*����rٶ�l^�N7̚
,�F#X��`��ؒn4d�3̚
,�F#T��`�Ը�n4�3̚�����V+fM�cP��`�Tk0�T��L���:餿�Aq7�����&_�2�iz�F���F���K�l�w��\Sf��lfw�]/�55Xvg3������ѐ��l��}��%,V�,;a��Ѹ
Hvow�q6���4�FC�:���t��Qf�5��˝��n�$9���?�N6�,9�!Xv�F�*��^,k�l�1�ՙ�eM	����l,i�\�1rՙ�eMYB>�a	�˲�\�1��l,g�5�B���r��Ҁv�tr�Π��QUfcYS�/U���4�����>F�^l�)����*�f�_�Ȗ�l���ld�)����F��2W��A�:����"!�:f	�K�JƠ����R�)��ld�)�4�]'���0(��0��ld�)����Ff�ǖ�l�m��H�a�Ά`�fcsM�-�� [���\S�%;Bՙ�U~�#W��A�:����,!�:f	���rƠ����\�)��ll�)�4�]'���0(��0��ll�)����s���Q�q��sI�m6�5X� ��J�������Vg6�5X� ��:����q��Ug6�5U	�Y$�V,̚jƠ�����`
�2̙K�U�a�TAa�������&_�2ə�K� ��v��H�aو�U��dM�-1�luf#YS�%#Ug6�4e�d� rՙ�dMEB~��%�V,���u�j�Fr�R�)��l$g�,hWI'IS�#Ue6�5e�bP���L�c gs̿���)��c��w6�5E��m���eM	��M����)re�h��l,k��Q��;˚rƠ���)�`
�2˙"K�U�YҔA�1��;˚�|1��l(g��.����v��P��`�<�U�eM�-�gclufCYS�E�lUg6�4U�h��qՙeM]B���V+eM�cP��P��k0�T��L���:�hB���y6��2ʚ�|1��l(g������o��eM����ʚ*[f6�(kj��l�7P�T�2��� @YS�P���5�:�A5fC9S��Re6�3U��뤳U=lpT��P�T�AUfc9�tg���t�����������Ɩ� �v6�5X����͂IS�J^���Y0k�r
}��f����a�0�s�Z�)��l̙K�u�����Q5f�`���A5f�H��Xo���z�m6�eM	����:�Y,k�l��h�Ve6�eM	����:���)reo�W��X֔%���P�jŲ�)�a�1˙r��*���)�4�]'��㈠�m4DU��eMQ�Te6�3}ΟN�����fCYS���h�4ʚ*[t�fluf�����c4Aՙ%M�+:F3�:����K�s����P���0՘�L�SH��P�TYЮ�����)��l(k��Š*�����J�B�|;�l(kj��l���~��U=�lufCYS�%f3{,�����Xh�3�����Xh��Z�(k�u�j̆r�^�)��l(g�,h�I'�z:�QUfCYS�/U��L��ӷ�^�N7ɚ",��!X��Hْ֔;d�3ɚ",��!T��HҔ��;�3ɚ��2�~��h�dM�cP��H�Tj0�T���L���:��ƔA����F��,_�2ən�u�l��f�YS��f�J�����efCluf�YS�ef�:����qefC\uf�YS�P,��Z�0k�u�j�s�Z�)��l0gj,hWI�IS%f��*���������f�#���h6Ӕ`�C��4ɚ2[�'�ՙ�dM�<�I�:���)s%q"W��H�T$��Y�nŒ��cP��H�Tj0�T���L���*�$i*��!NFU��dMY�Te6�3}��-���t�����v6�4�kjl������
,����lp��q%;�3�j��c��[��7;�a�1�i�5�B���K�U��DS�;FU�N55�bP���L��j gs���Yp����c��9���"[v�6=g��\S�e�h�s66���c��9�j��Q�����5�:�A5fc3M�SH���<Sdi@�N:;[��0��ll�)����g����20<�2�A ���r6�4�k�lI����F�",����ld�)s%9�2���*!g5X�f�Ze���a�0�Uf�J���Ye�)�4�]'���lUc6�L5e�bP�٬�3��;�s�٬�5X��X�٬�55�lgClUf�b�T`��PUf�b�Ը��qՙfMUB�u�V+fM�cP��`�Tk0�T��L���:��A��QUf�YS�/U���L������Uf�",k��\m����Vg66�4A Quf�ʽ���Ug66�t���Z�l�i���TaI�a��H�	�� �4u�I'����2�j� ��U�dU��:�N7�iJ��lVi62ה��A�:����K̆Puf#SM�+1�3�j*��V+�UVv��Tc62�Tj0�T���3e��뤓U�A��0��ld�)����s��e��/���n6�55X����*͆���� `lufCYS�E/��l(i�\��Ug6�5u	!��V+eM�cP��P��k0�T��L���:��/(��l(k��Š*����z9/�:/�����&u��ll�)�%�:���ll�)��I���3�j�\ɤN�3�j��G��Z�l�)�a�1�i�5�B����"K�u��DSœ:Ue66��AUf#3M�s���gcYS�e�h�4˚"[r��lufcYS�%�h��3K�"Wr��\ufcYS���bX�jŲ�)�a�1˙r��*���)�4�]%�%M�1��l,k��Š*�������З�c�W�iJ���y�X���Ɩ�>O�b�T`Y����+&M�+k}�>zŬ�J(����B��5�:�A5f�9S��Re6�35����ä������c�W̚�|1��l0g����4���v��`�T`����l0kjl�� [��`�T`����l0ij\�� W��`�T%��%�V,YٹcP��`�Tk0�T��L���*�0i���lUe6�55�bP��X�4n}~};�l0k*�,g�Z�m�i��llufcsM��gAՙ�M5�[����ll�i���6+���Z�1��l�6�4l}�
l I)m}6�:�$��>+��l�6�4l}6�*Hr����h�og������lVg6W�k�lɝ�U��U�",��!T��\e�)s%w6�Ue6W�j*�?KX�X2�T�0՘��4�L!Uf#�L���:��ƔA����F���|1��ld�鹤q���n6�5EX֍F�J���)�%�h�Vg6�5EXҍF�:���)s%�h�Ug6��9�����V+�dM�cP��H�Tj0�T���L���:餿�Aq7���F��,_�2̙>�P�����|������c4�U�fM�-9FC�:������c4Bՙ&M�+9FC�:����J�G1,a�ba�T�0՘�U�a�SH��`��XЮ�N���1��l0kj�Š*������o��eM��lVi68��ؒ��ՙ�5X��!T���TS�Jv6�Ug68�T%�_�,a�b�\S��Tc68�Tk0�T��35��뤓S�;FU�N55�bP���L��r���j�N7ɚ",�F#X��Hْ֔n4d�3ɚ",�F#T��HҔ��n4�3ɚ�����V+�dM�cP��H�Tj0�T���L���:餿�Aq7���F��,_�2ə�@��1g#YS�efC�J���)�%f�luf#YS�%fC�:���)s%f�\uf#YS��,��Z�$k*u�j�Fr�R�)��l$g�,h�I'�:�b�aT��H֔�AUf#9�c���$�8��Z,kJ��lVi6�5E��l���l,kJ��lUg6�4E��l���l,k���V+�eM�cP��XΔk0�T���L���*�,iʠ�lUe6�5E�bP��X�4��v��X�4-�J���i<����Ʋ��XhAՙ�%M���Ug6�5��B��݊eg1i7�Ta��a�n4����Lӱ    �FS%�%M�Њ�2˚�c�M�
�%�Ҝ����f�Y�4g#�J�Ѭi��1�:�Ѭi��T��h�4��W��h�4�٨�݊eY�,g�U���6͙f9����LÜ���H�i�4��(��l6͚f9���$�՗������Л�4%X��!X��l�5e�dg�lUf�I�a�ΆPUf�IҔ���rU��&YS����Պ%YS��Tc6�3�L!Uf#9Sfi@�N:9�aP��aT��H֔�AUf#3M{�xg��G�6�i��dg��J������;f�3̚
,�� ��l0ij\�Ά�����*!�:	�k���R�1��l0g�5�B��s��Ҁv�t|
#�pg#�*��������Fr�ǖϳy|;�ld�)²��*�F�2[��A�:����Kv6��3�j�\�����F������%�V,�k*u�j�Ff�J��*��ʯudi@�N:9�aP��aT���TS�/U���4M'u�|;�ll�i:��`�f#YSfK�F�?�s��)�ѦO��$i�\��h�'un�5	�}���:7ɚJƠ�����`
�2ə2K�u��;��NGU��dMY�Te6�3=��P�>=ԹY֔`鈁��Ͳ�Ȗ����,kJ�l���P�fIS��FLun�5e	����Ͳ�\�1��l,g�5�B���r��Ҁv�t6Kc �ɨ*���)����s��e;�;�Ƿ����˺�Vi6�55�������K��Ug6�45�������*!w4��Պ�YS��Tc6�3�L!Uf�9Sci@�N:�odP܍ƨ*�������̆r���,�U9�H����M�2�����|�W�eO�����΄(���7t�Q�+w`H_��L�2�ߥ�\ܾK[�p�M�^�C���|����V��T��6�i')��wp���]e^�]�*����0��pˁ.��t�a�U`َ�t�a��ؒ��r������.7L�W�c�]n�aU	�W��r���a�1#̯j��*����4�]%&X��@�fXM�Te6�_���^�N7���	��l0�jl�]�8���������s�`5��.��a�U%���?p<�V��Tc6�_�L!5f�c~�XЮ�n���⻠��s;fXM�Tc6;�W��No����\�-�J���`��k�eX�-k<����nV�e���\�-��\Y���7�v˰��ry=�͵�2�\�1��lv˯r��*���*�4�]%�%X�4Lsm�+�����f�g�R}����f�,k�&X��ȼTfKZ����ld^*�jBՙ�LKe������F����ܖ�V+��K�:�A5f�JO<�`
�2���,h�I'���[�Ue62-��AUf#�R�����6gcV��|���X�ٲ>��l,�J����;K�"W������eXYBy$r���2�\�1��l,��5�B�����Ҁv�t����ΆQUfcV�/U���W���1�}��H�a�1�*�F2�̖�[��H�a�1���F�̕�W��H�U$����Z�$�*u�j�F�R�)��l$��,h�Igg�J��Ue6�ae�bP��`~u�l��e�׷��3�˺�Vi6�a5�����3�K��Ug6�`5�����3�*!w4��Պ�V��Tc6�_�L!Uf��Uci@�N:�odP܍ƨ*���������g~g��v��جT���h��ll^*�e�h��ll^*��n��w66-��n��w66-�%����w66/��0՘��J�L!UfcsR���:鬿1��T��شT�/U���Wosrn����8+U`�Ά`�f��R�-�� [���T�%;BՙNK5�dg�\uf��RUB�u�V+�K�:�A5f��R�SH����Tci@�N:9�aP��aT���T�/U��J}�Cǀ���Ʋ��̆`�fcYSdK����Ʋ�K̆PufcIS�J����Ʋ�,!/X,a�bY֔�0՘��L�SH��X�YЮ�NVu�fè*���)�����f�n|n���-kJ�tt��>w˚"[6�`���eM	��.����nIS��FL�s��)K(��O�s��)�a�1˙r��*���)�4�]#�aIS%��?�yX��A5fsج�-�F{};�l��J�lgC�:�90kjl��٪���������������q%;�2���*!�:f	�K~�sƠ
�90g�5�Bj������4�]%&M�lUe6�55�bP��X���ٜ�w6��J%X� 0}gsH֔ٲ��;�C���f�lI�2W� 0}gsH�T$�K��;�C��R�1��l$g*5�B��f�N�|g�4U�I�T@I�����dMY�Te6�3=n�h���h�fM��Vi6�5�FC�:�ѬiލF�:�Ѥ�@7rՙ�fM��X�j�Ҭi܍�U�@��i܍��@��iލ�4u�Y�t��QUfsX�%�9������-��v��X֔`��f���ò�Ȗ�l��(8,kJ�lg3{4�aIS��v6�G�5e	����Q�eM�cP��XΔk0�T���L���:��&7�*���)����s����L��y};�l0k*��lVi6�55��l���l0k*��lUg6�45��l���l0k��V+fM�cP��`�Tk0�T��L���:�hUWP`6��2̚�|1��l0g���.fs�n6�5Xj6 �4̚[f6�Vg6�5Xf6��3L�Wf6�Ug6�5U	e�B	���Z�1��l0g�5�B��s��Ҁv�t��#(1DU�fMM�Te6�3ݷ�l^�N7̚
,{��`�f�YScK^}F�:������W�	Ug6�45���g�3̚���r0KX�X�5�:�A5f�9S��Re6�35��뤓7���̨*��������s����"��9���v`�T`ٝ�*���Ɩ�� [��`�T`ɝ�����ƕ�� W��`�T%�s��Z�0k�u�j�s�Z�)��l0gj,h�I'7���lUe6�55�bP��X�txA`����a3M	��lVi6�55�$g�luf�YS�%9Bՙ&M�+�� W��`�T%�KX�X�5�:�A5f�9S��Re6�35��뤓<���j��Ĭ���j��Ĝ�r�����׷��攬)��AX�ٜ�5e��l���lNɚ",6DU��)IS�͆���攬�H��HجX�dM�cP�ٜ�3�L!5fsJΔYЮ�N��
�FPUf#YS�/U���L������t��������*���Ɩ�l���l0k*�dgC�:����q%;�3̚����%�V,���u�j�s�Z�)��l0gj,hWI��)�������&_�2ʙ.��z��~��n6�55Xd6�4ʚ*[`6�Vg6�55X`6��3J�*W`6�Ug6�5u	?,��[�`e�:�A5fC9S��Re6�3U���������4GU�eMU�Te6W˙�w6�o����4M�lVi6�5�G[��X�41 �:���i<b����Ʋ����Z�,k��*l �ٝ�V`�^�l��N:{A ��QT��X�41`�U���q��}���4EX��<����Ɩ�>�A�Ĭ������/��45���y�'fMUBn������YS��Tc6�3�L!Uf�9Sci@�N:�ZxA@PUf�YS�/U��G��?����r�,g���?}=�p>�_�}X�Wh��|dN���n;�Y��#w�ڻ�|E֙�G��;g���΀>򧿐�m����J��A�E} k��#�����aUf��C��֐����+�/��C�*S�Ȥ~�r XeL�I��6p�nJ�KX�� �*	s�Ɩ�6@luf��T�e� �Έ0�j\�k�UgB�KU	%��V+�R�cP��`&Uk0�TfR���:��%� ��p0�j�Š*��L��:�#�׷��s��̆`�f��TcK����s�K̆Puf��T�J����s�*!/X,a�ba.U�0՘fR�SH��`&�XЮ�NVu�fè*��\�����F2��}�~�>�l0�*��~�`�f#3P�-��A�:���K�wUg62�����3��*�KX�X2U�0՘��?�L!Uf#�O���:��v�A�����F&��|1��ln�I]/�e`��e�����?%XֹF�:��a.�ؒ�    5d�2��R�t���ln�J5��s���憹T����X�fźa.U�0U��3�Z�)��ln�I5��뤓^Hŝk��1��RM�Te6�I}�=xG����s�Kg�LG��3P�QC�:����;j��3��:��rՙ�N@xG�%�V,�����U�@��J�;j\�$������4U���Ӂw�Ue6���.�o&��v����e`g�L7�J�tg�J���Ȗ�l���ll*�������&�"W��!�:��	�,��:F	��~�cƠ����\�)��ll�)�4�]%�M?eP��AT���T�/U���?������t����:��;�U���R�-��A�:��\*;Bՙ��R�+��A�:��\�H���,a�b�	;�a�1ɤJ��*��L*�4�]%��R��0��l$���Š*��L�r�nI"���n6�KX���*�s�Ɩ���luf��T�%���l0�j\�;j�Ug6�KU	�-.��Z�0��u�j�3�Z�)��l0�j,h�I'o>2(~G�QUf��T�/U�eR/�uY��r������M��~�G��^i>4�+{`@_��L�f�~�F�]gF4!�+w`H_��L�&�~��sq�.m������u;�1)����fG�UfE�S��6�i')��wp���]e^4Q���C�*ù��带a�׷��3���ViZ2[�ْ� d�3+�����.�Pu&%�U�+�B�:s�ɪ"!�'���
&�U�cP��\U��ReB2S�YЮ�Nnb�1��td�*����F���c����@o2Wai����@o6[ٲ.�鏁�l�*��.�ُ��l�*re]n���dU�P:��?z�٪\�1��ll�*�`
�2���,h�Ig}���2��ll�*���������s�l����K_���I��ٲ����Eo�aEX�����M�̕�<==,z��H(�O��$�*u�j�F�R�)��l$��,h�Ig��aQAU��dXY�Te6�_��3������6�;eY���z4���N�֯�}���j}�l�7x��f�\�)����owA�[��u�.�{��-�wʼ~��!p�I�)���fG�5fu���W�5�$�vs�gGטם2�_eט�]r��#Cg��dc��ViZ��e�x��luf%�X��;&Dՙ�$c�+�11W�9I6V$�_�"a��I6V�0՘��b�SH�	I.�YЮ��Ow�Ue:��e�bP�٬�i���o���dc��Vi6��e�$�luf#�X�%� Bՙ�$c�+�!W��H6V$�l	KX�X���:�A5f#�X��Re6��e�����d���\���F��,_�2��.�m�习���6��
,���l��k�lI.�����KrA���f����$C�\I.�r��`I��%�l	K�+VKRT\�1(3��$��SHj6	$��K�U�a2VAq.�Q��D�Vv��|$��}�����|;d6,X�����b6,XՕ-0e��&����1T��P2V��Q�:��l�K��`��݊+��a�1��z��*��\��4�]%%cԧ�8��l(��Š*��y����:�X�4�%g0ˎ�Vi6��U����̆��K��Ug6��U����̆��.!Ű�ՊE�W��Tc6�s�L!UfC�Vei@�N:9[gP|�ƨ*��L����̆r�W[�������fCV�%;�U�eX�-��0[��P��`��QufC	V�w6�Ug6�au	�ױHX�X�a�:�A5fC�U��Re6�_U����S�;AU�eXU�Te6�_M��~��n6�aM��Vi6�aM�є��l,����l,���)W��X�5=Fs	��2��1�Wa�^���ѼH�J|v��4u����1�����2��1��WAz_�����ߗ�e�\��n�����c�
��r�B+M�#����w���Zg<y֯�ޭ�+��|>��9{���u��k���o��/�V��l�/�s XcD��_�f�2��|�w��t�d|_��BV��G�����*c¬��5��~���tS�y�K_��}��](�lֳً�w��lX������({}8��1�z��������X���l�:�A���< ٫����V`�^��w��N:{O>��QT��<`�������$9�ْ=��|;�l���k%Xv�F�J����Ȗ�![����V�%Gn��3�؊\ɑrՙ�Mle	�؆%�V,���u�j���r��*��Y��Ҁv�trϠ�ȍQUfc[Q�Te66��:�>�u쵁��<�>�*��f�"[����k,{#8��Pufc[�+{yz쵁��<�>KX�X6���0՘��k�L!Ufc�Z���:�������Ue66��AUf����jIG^���n6�K%Xv�F�J��\*�%�h�Vg6�K%Xr�F�:���)r%�h�Ug6�Ke	�(�%�V,˥rƠ��L*�`
�2ˤ"K�U�Y*�A�1����r�(_�2��z�3u���m"X�[�`�Ά`�f�3[�-�� [����V�%;BՙNl5�dg�\uf�[UB�u�v+��f�:�A5f��Z�SH���Vci@�J:�֪�xgè*����&_�2�׺�w6�o����k%X���g��Tc�v6��l0�*�lg3��S�ƕ�l���`.U%�_���l0��u�j�3�Z�)��l0�j,hWI��T%;��w6�K5�bP��H&�8�w�^�N7ʥ,�6��Z�f5��[���lU�e�&��� e3��wԌ��ll�*K(C�f���]l�*�a�1���5�B���f�"K�u����5EU��MVE�bP���\�c�A��� `�T�efC�J��\*�%f�lufc�T�%fC�:��T*r%f�\ufc�T��,��Z�,��u�j��2�\�)��l,��,h�I'�:�b�aT��X.�AUf#��s�GS?��n62Wa�웱��,�����f�:��٪�f���N@�dU��fߌ���`�T�|4�HX�X2[U�0՘��U�L!Uf#3U���:�l�R>�ZPUf#�UY�Te62Wu�̾��o�����$X��`��ؒG;���l̚
,y��PUf�`�Ը�G;���l̚����#KجXfM�cP��,�3�L!5f�`��XЮ�N^�eP�h'�j�f�����j�f���cu�F�M7�Ų�ˎ�Vg6�eM�-9FC�:���)��c4Bՙ�%M�+9FC�:���)K�G1,a�bY֔�0՘��L�SH��X�YЮ�N���1��l,k��Š*����~��o���dM��#�� ���B{� �lufc3P	��#�� ��T���LoXl*K(O�OoXl*�a�1��5�B���f�"K�u��܍�A@PUfcPQ�Te6�3�����O7���lgC�J�����%;d�3̚
,����l0ij\������*��YB�u�V+fM�cP��`�Tk0�T��L���:���A�ΆQUf�YS�/U���LS�y};�ll�)�Ҝ�|�����e9��f�YS�e9��f�IS��r6����*�d5�fM�cP��`�Tk0�T��L���*�0i��$g3�l0kj�Š*�����q>��n6�5Xv�F�J���Ȗ�![���T�%�h��3���\�1rՙ�M@e	�(�%�V,9��:�A5fc�O�SH����Sdi@�J:�~ʠ��QUfcPQ�Te62�����o���dM��>��l$k�lI�3�ՙ�dM��>��l$i�\I�3rՙ�dMEBn�e	�K�׹cP��H�Tj0�T���L���*�$i*����QUf#YS�/U���L�����5%X�6��˚"[�6��˚,{mz��%M�+{m~��eMYBy_k~��eM�cP��XΔk0�T���L���:��ǁUe6�5E�bP��`�t�l�L���v��`�T`ٝ��i�Xr�����Vg6�5Xrg3{�����G3<�qՙfMUB>��>��KN؃ٝ_���$����ί�@�;�df�7�:���4���Ue6�55�bP��X����x};�l$k���m���E��̖�M1�H�a�1���$M�+;F�>b`���H(G1�G��5�:�Af�J�Tj0�Ԙ�*9Sfi@�N:;[OG    (��lVɚ�|1��lV˙/��lVɚ",��L��Y%k�lY�f���*YS�e9��w6�$M�+��L��Y%k*JVc���*YS��Tc6�3�L!Uf#9Sfi@�N:�#� ��*���)����s����L�F{};�l0k*��lVi6�55��l���lVZ�����������qՙfMUBX�T�j�¬��a�1̙j��*�����4�]'��

�FQUf�YS�/U���4��`gcYӁ��*�Ʋ�;f�3˚�;Dՙ�%Mv6�Ug6�5�و�Պu�7z��j��l,g�l�H��z�\����%Mv6��2˚�;���d3M������t���)���U��eM�-i@�:���)��Bՙ�%M�+i@�:���)Kȗ�,a�bY֔�0՘��L�SH��X�YЮ�N:a70��l,k��Š*�����<���v���LS����L�F[%k�l�s5ӻ�Vɚ",{�fv7�*IS�ʞ��ލ�J�T$�'O�w���5�:�A5f#9S��Re6�3e����������j�w���5e�bP��X�������v��H�a鈁��լ�5e�l����jVɚ",10���U��̕���\�*YS�P����\�*YS��Tc6�3�L!Uf#9Sfi@�J:I�
(10���U��,_�2ə��|R����f#YS��f3}R�*YSf��f���U����f���U��̕���I��dMEBY��O�\%k*u�j�Fr�R�)��l$g�,hWI'IS%f3}R�*YS�/U���L�}�l��f#3M���*�F�2[b6�Vg62�a����ld�)s%f�\uf#SMEB^�X�jŒ��R�1��ld���`
�2�g�,h�I'�:�b�aT���TS�/U���4ݷ<���v��H�a����ll�)�%f�lufcsM	�����Ʀ�"Wb6�Ue6Wɚ���`��͊u���\�1��l�6Ӕk0�Ԙ���"K�u�ɪΠ�lUc6W�j��Š��b�t�l��w���l��b�T`Y7����YScK�ѐ��l��5XҍF�*��b�Ը�n4�3̚�����V+fM�cP��`�Tk0�T��L���:餿�Aq7�����&_�2ʙ.��5�g���t�����"�1X��P�T��Q�:������1T�٬��+W`6�Ug6�5u	?,��Z�(k�u�j̆r�^�)��l(g�,h�I����4GU�eMU�Te6�3].���l�N7̚
,�� ��l0kjl�Ά������w6��3L�W��a�:����J���E�j�¬��a�1�+�b�L!Uf�9Sci@�N:>�P��T��`���AUf#9��6� p�� p�����lVi6�55��������K�lUg6�45��������*!����Պ�YS��Tc6�3�L!Uf�9Sci@�N:�1eP|gè*��������Fs���f�;�i:��AX��`��ز��l0k*����;L�W�����fMUBI����`�T�0՘�L�SH��`��XЮ��^�w6��2̚�|1��l,gzM��y};�l$k����U��dM�-yA ���F��K^ T��HҔ�����l$k*r
�%�V,ɚJƠ�����`
�2ə2K�U�I�T@���2ɚ�|1��l$gz,f��7ɚ",3�U���5E��l���ll�)��!T���TS�J����Ʀ����`��݊%+;�a�1�i�5�B����"K�U��DS�fè*����(_�2˙��<��n6�5%X:�f��X�ٲy6��Ʋ����L7K�"W6�f��X֔%��(��Ʋ�\�1��l,g�5�B���r��Ҁv�t�4eP2�f��X��AUf�9ӁP�>=�y��)����:��5E����ΫeM	�� 0;�y��)re/�uZ֔%���P�fYS��Ta6��L�SH��l�3E��뤳B���1�Ͳ�(_�1�Mr�Ǟ?���v��l2�a�1���f���̖�![��l2�a�1���f���̕�!W��l2�T$���Z�d���a�1�i*5�B��F�2K�u���:��c4FU��L5e�bP��P�����y�s�O7˚,u��l,k�lI����Ʋ�KB���3K�"W�D�:�Y%k�r0�%�V,˚rƠ���)�`
�2˙"K�u�IҔAq��QUfcYS�/U��4}l���s5�o��fM����ld�)�%�h�Vg62�a�1���F��2Wr��\uf#SMEB>�a	�K�JƠ����R�)��l�r��,h�I'g����Ue62Ք�AUf#3M�[><���t�Ѭi><a�f�Y�|x�ՙ�fM��i��3M���Ә��l4k�O	�K����4����L��iR�$˙��Ә�N:K����Ue6�5M���|��>���i�5�4ڦW6�'�ǖ����������Xx?A=\�z��H�o�
�N u���x���ٲ��__��+����z�3�u��p�^�-����ُ���e=��/?�(�����������_^�*����zΉ'P����׷ꝕ���9�<e	a{�b��������亥R�o��w�BP�����Ϸ��CP�} ����휋9��{��}T���mh�o�f�g~�zn��FT�|I|���h~�(\�+�T��X�O_�r� �m�
�՟o��Y�u]>��i8�]�'�����e�u	��կ�گO���������X�m~�վ,���qZڃ��/���z�W]o��V�8���!����ە�9@�|Z������Ƿ�k��P]o�g>�F>(�|#�A�{k�v��?���Ғ���[EE�h��}��q.y���[EE�؃��~ ����=�I5���6��O�]~�y�ח|(t%gN~��+f_�֎�o� ��{��_i��q�+����M�
��}G�4*�
V�۝��:>����7��m�]1�����;�ؖ��+��
z:W���/�^0T���z~��_U�R-����&���)��V�
eT|\��^L�_z��rcWNO~�U�ȕ����j���A_�*����\o;��ׁ�#W����]��Vڇ����6��ϷzV��m�?+��س.����_���8�������C�s�=�10��ɘ�p%}C��#��a�9N�M��
]�Յ���g2� �ɼ��h�������G��_�᯾wD�_�9O�: O�o�����~9a/8�Ņ�v�7uy��Q��/����}��n����$^�**Z���vY���1��?t7����_`�7WjK�����x�-��g\���~���7?���]�p���T�M�;WˎW�[~��|G�P��z��G����I�v�$�:������W��sC���v_~��������������SW��7W����W��/�~s%�o���_}�����M���B����Ç��{x���F�f��һ�׷���}�ƢӢ���V}�s�暵�nu�����ՙ�&�P����7���/x��0%U�k��sb`��U�W��y��������U�-���Pɔok.D���t�}�<ء^u�z�ޯ�m���#�qؼ�[x~��;��%�#o�|���������<���S��[��j?{����x�oU��� �������_�j{Z�����jŕ�h�<��LO �N�N8�{�VJw��oU���"�ߖ�o=yv�ޟ����Rb��һ�/��D��ډ�����������#Z����9���mw�i�R?~Cu9��=�<��])�������[jo�ڻ�'�
�o�c#T��F�^�.���,�9~5�Q������z	o�ߙz	P���Κ{}�L�-�W�U6X���P��r�7��<�}J'4����L��f	ޠ��udG���f�J��I��о��ɽi$!����}I��� =�Gha��-��S���]Pt��6O�k��,l�z�J��o���8�&�Ƿ�4����U�q{[��:o�^���3柾�ޘ���*����H�i�u��}�;�������zw�s-k
k���+E%�?�?��I�CA���=�q�uE�ep�:��k����C�.�X�5|��[]۱���L]��y������*��cO� "  �����g���`�|롒��c�.ԡ�\ ��^_r�����3u�-�q�G?�տ+�
`]�$�yf��U��{U���4���ߓp;���ߌ��~���*l�#{~��-�B�����x���E틜b���%n>yc���$�=�ç�~�UK��O���nғv�{��:��0��Oif�Vhn��F�?��⍩;��<����_2f���]=wj� �>����a����V#x�l�Q�����s_��NAM1��'.q�����*����Ƿ��č:oJ�堶c���/�-q���=�j�Ȗ�MN���J����%���Q{A�wα���>W4��� ��ɿ��C���H�����a��Û�g�����l�5��Mw�v=�:������cQ""u�=k_�گ�����6u���_���r�?���s��w��z}�U���]��v�lD�ݰ���
��W��V:�!�y}��s��DoW�`�����J�%ޙ�d�s�w�<>������o<-t�����(z}������v�|8ؾ�=�����_8p=i^� ��������9߁�9��D�_"�Oڼâx�뙡���׷
��IĿ�z�������:�����g	����#�C��5�+�w	�37�������oR�Na
�=��\��~���!�2���ڎ����5��}u=���~��<��?��߫��6�T�X�*����`���Г��[ہѰ���]�Ώ�?v:?~�_�t�Ϸf9+^���~�2�}�ug�֝_�py�G�_�����s���+���P������ >6g���������7�xiU�y����}��3��f�R�� aP��j�d�1�k��ջ�;l��w3�6��[�K��]�C����q����2��!,"���k�����y�CGE|�/ȼ��.���
D����Oo���q�K%R�R^��h���UZ�o�n;�$�/Ư�����a]���y.��Om)���x�s�ѩ�sߒ	z|��C|G������d_������Ϳ����>g`�'���_����.���Yr�u����o+r����O��^��]���?��/Ư���׷+��yc��ϢC��o��>�7X+�Q�f�/��g������y���NI�g���J׭��>���-��[���d����|�9�������H��ﰶ�,��=���=�_����J;�g?L�ʿ�uX�/�7���6\`���Z�O���o���B�4
n=��Zo.��#B,��E��[��G�g�q�����
�'��z���|?}���J�{o�:�z>�G?k����/X�%��b*�AbG���;�����O�J"?�<�J|}�һ�7�N�$5��l�|�~o�z�� ��d ����J��ol]y9=/�q��S�#�~�/��GY��Y�¯��W���Mju�?j����������k�n=�)��V6_��K�5�;�а�<���rۉ;�`�7����yC�z~N �G@�ٺ�#�@��Ի{1�x���2��X�
�q�_.��?������Ld��      C      x��]Q��6�~F~E��v 	����s6k���^n�R��H�z4�%�7���&��5"�����*�[�Ght7������c-����J�Q�]�QgyT�W�H�Yq�����=���U���/�U�z�,���%��(I��_�h!E�TR(�$������)�q.�8��a��v�f��j]mwu���bU�wlY>��\����_��7���v�`��������,�s���>��d�Յ���7������.bČh��w���"_��<S��^FI�xt�b����<<e�=�=%�c1�)E�)�{J�с�����H/xĺ���S�WI�K��2Qr��Q�I�q�\��s�-�[�����o�����!Ev}'�"Oy�d�����*��,�u��\����3�F�glRĺ�I�ؔQC>���M�`�0���}��rq[��E�2��U���Ϳ\o��X�g|8<�7���<�o��?�|��XrX^��� ��,����桬���WC�P+n��[o֧3R}F�����aVX�hQ}�`�nʵa�j��C�V���]�_��uy:żO�(�T�[H1O�R�V����_�U��-��F9��fx��w�2�	Xv�fi��y�{�f�Vۍ�>��Z�O+�E�Z(g�@G��f��2�]���yݴj�Wdd�Y��&sxS� �W0����y����q	���<M2��%�$��_.�u���Cx����l��y���y�8����B<e��yyc~%�	q�<���0fP��<83�Г8/��̯�9�a �1O�<��1�u�@<g�D���zY����Z�s�k6�EN�
@"f��yǆ(4�2W �y��A,��X������5i��At���D�yg�AT(pAU�`)��f����jU��o��ն��xX^�Uv����bR3O�������6��\�!�����K�El���u�i�]��u��h�,�?+��W�7�,�+���WK�LZ�ْ�$�*����2����H'�B]��xi6�!߇��rлY����;)�7պ,k�[��c���`棌b~�hр�����<�����A��c2˝�+J�yj��,1�`.t�/rI�@�ɵ*�[g8�T�̌���Q�3���Z'�+P�2K�P����-`�߷��Jٖ�����~�,��b��FD�Q5r��l}oP��q�!�A�J~��k������V����(W�8���%�{�v��U�?W��%����F5ۇ4���	�Z�\�ICO�w��F��'+���:J��L�<�N�*�ţ���ڏ�jE���	Rq�usOE60!��g )�'�=ٮ��w��%b��ϩ{�ٻ���m]��L��y���z_]�8�̙ur:�$0H��A�b[���C�5�d-��}�:��+C]S�<f�ti�,�O"^�<�m<��� 	���S<.��~��$�����{	�L�Q�̓x�W���X)��$��H��3�	Xб���,��'�,5��̆o�Ϯ\�ř�:IȺ���o�Y�q�Gm�)8ɧS�BR��2t����r�9+�@�o���ge�$a��e��ܘɰj6�3�"ZJ��7X-�X-u� �u[�ε8��d������W՝1���<_TJz����_�!�a�]��+c30_В1�]m������L��/[F��f��n����Q\i�����/��Q�W�(&|��m_��m��?�&h�7���IC�c��uV�qt�����H�,�I�PE���W�(ґ^J���R�I��C{r�cF<�e�˫(+����ka<�E�.S�f�B~Z�$i֘��E�p��}2O��\�����x��[���6ۄ�f{g���Ip,�V���]��"��F��"cW���{<�1T0M#�Jq$Z>���a�L���<�M�_V��K_`�ytܛ�"s�Z����{�^H�ykC�+ƎXj�6����$Q�̮g&�/u�ܵj��Y,�ـ;ݺb�����1T �c�y(�̓p��|SD�B�YFC�KQH:C�ŷ�����MG�����J@;c^�.�V��,7�������@c̬�b9�T-�~��5�d;Z�7Xx��O��
�� �t_����u]]Wcg�j�� ����$'E��4lj,�GH�XZ�V�YG�M��)t��r�;�Vd��r�^���b��b�u����!�B4*o ��'q~.D��/ѭ�@*c�����":�f�yG(2����)�2���sp	��qN�����H��K耭���B����q	�8�\�Q����%q���@E�s����Hc�����'q~.dM��#�e�%g�D�	E����VwF������F��S��,��35P�x���N������Y�rx&����?t��']Ɠi�r��[�5�,(�Yg��4X��T<��!������[_f���'��<�>��Q"#�wJx��5	����Tmq�c����o�μN�ܝI��<if��r��ßgm�I(�U��v	O��گ��?�m�C@�*�81kO�q�a�������������X�T�`����y�}C�U���0'��s��y�-D)O%�k�(�D�$�y��k�`��"ͮ,�Z$y|��xj���2�2-��y���2/��A"M/���1݋������d�� �^IXm��8���b�+�˺�dD�;�Ŋ+�k]���j���m��fa�~�鎤͜ʙ'2wK:�$Iֆ�I
,�y���D�M��6C(x,;�g_əI+{3� ��{"����bH�)�e漧��s�U4�\�� �2O��*�m݌
��t [�۴k,:2�v2?���D9�<F0���Xt���IJ���U�y_+v𻲮~���e��W5��(����=@�{�7��yrN��~]8s2M?c��[��R'|&�@ޤ�xb�����;c�[��O��3V�|*����O����+2e`�f����vӤ�7�<�����"�wj��"��j���2J��8��*�r�j��Rw5�y/R�Pϲ�(Y^/��[����s��+�O�zF�ƺ����æ�7����#n�>C®"��ys/����[��r?Z�ï�/���yF���2z�gz��ӓ�ݾ6Sx�aD���tXC�x9��4�ow���M��{j9����i(�44^�F�{�_��z��͜�2��HA���T���Ğ3A��d� ς�Ș>�q����mSߺ�vS�v���'R$�^�i/�~��K�hEη���r|��W�2ށ"�x����Z�#�[���_��4�^1'd� ��Z�头-�k]��2Q��� f輂_x_��+�9<��Ħ0ﮗ�t�~��T�~����=�5�%�2��s�������I�{���F�$d�<���V篠ǥM(���Ct]��k}�N�C�<��NN�a��B�n&�6�l ��/�E*/���U"�H�������׵�P�~$e���F[y'��h����i�n	�=�_&c��J��X�'��!'�c3�N&H�R�W�$��	ZX����M�����L��ސ�-������,�<�ռ�.8�D�%:K=��/������ }r�L ~LMɵ��a3,z�܌K�h�7e��Ѡ]�>����hv]�,,m<�>9D�#�\ʤ��Ǣ/`�����rqX!ƆpΈ��fp��aK�}�eB�ڭ�H��YX
Ɉ��9��_��X�_�xѧ��P���$j��?�U��1"�bK��xYdd-�f_~_�?_V�-#�q6�����$dn9������b{_�
F��B'��DXe��ǡ@��?���#	�e�xt`|[��X=��g%훊l��4�q��#_[{����^g���TB1=�P��1s�ŷhQ�߆
����輮C�Y���
3력�E�a�����k�6ȗ�}�2ڇ�@ܖ�X�)�R����=n>
��"<�X�=�-�,̓�L�p�c�ļ�h<h�1:�:%�R���G�D3O����z��s��󏖟q��)������8�����Z<@�o����,Ɲ�R9wЯ6U���M�t�'    ����J�-:�X�9Ȇ��VҊy#3i×F�7F(�$t*@�%a���ڹ�N�@�m�ǢC���j�5�s���̓8G*d���?iK>&Zf�f�"��2z}�گ>5�$��b��n���C�"��fS1�����5��ݾ^�>Ȋ��Swˉ�n���C��?����C ���fp��E�k�cѡM��>�!�ֵFZ1Oj�As;vڵ)��Xk��~�ȸL�dz�̛�6������70Pߘ.t��o>&SRFi~]�Y
��Y]���������O�mJ������Z���\�t�j0D8�D��r�t�Z`{*a>
�-����ꥶ��뛛�_��m��p���Ǘ�vc�;.atPg����}렅~�~�;�N�����I�I��,��7@�a���گ�c+4�C0OꉘwP��%��eЛⶸg���\�v�¢C�dN�!�SNr� ��Z��V��<�I{G{.h	���-:�w�v��l�~�y�P���G�	N������CdI3���9a��j���|_�*7�>��W ?SctppC|3�����?�O̓�����;z���t�b�.��Y��c���M���4%F��!�W+w�rd�e~߶XfGM_8Q���<�|YtH1�-q����GӍ����t�u�f�6<C/�L	ô5%,:4�dₙ�SK"g�+c5�+�M4~c�4y��,:4�$���Y�W� A�'������`;��a[�� ]b�.9��ۣn+2�<~a�n�pJ�3H��D�z�B8��'� ���D^�)9Ikh$�)h�<��K+uƋ��-:H3TF��n[�TF��J��(KGY`tз���OŶZ2O��<
NN+!���t��(3<���X�Qbt�]H��T�B_{��j>C���L��ڠCo����X�3B[Hd̓<j�K�9�1:dI�C`�qbI���ߺ�T���㉞jMLn��ّ���!W�w�w�>�ź���̓{9� s3�"���|Y����?3O|Ɣ��$�o׸%�%0лr�N}��z/�"��Y]����߯^�]u!�(
�����m�Ĳ�D����CTI%<W?N�B?�����f�<ɩ�"��"�0:�6%����$U[F훟�� ���Tl���b��	HzV4�Ї}���R���1e��p�)�5[f/� ��ղ0���N��5E&a<h`�<�kUJ�Bd�V���ܔϚ��@�ѡ�%��`�����X�>�V��#W�E���1��)��s�7�ouu�YW�ņy����v�rw�9r�t�{/�&a�`��D��l̅�Ⱥ��8���V��n!.���iM[;vݩH��.9h�%��*=�5P��'13\�����tIJ�b�o,�Bښ��I�̤H�E1�fi℁`�{"x�3�w��gR�䴼9�!'� ��
g惝G�b��w�����e�E�� �[�D��lwh�\"E���$c��������}�*�E�K�_�Cr'�Θ�"��d0��RV�y�䖅��;��/�����y�)�D�m�Sb�C�;������Wգ�b%�d��yk��.�բ����&�<�Xm������S���?X"��5�H .�����[���:s)Bّs'.B��ϸh����U�_]��y�3\��S�ݦr,���{��F£ �������q��_3Ox*�	��\�ӼwJ�@\";M����b�УR2���9sq��A��(y"�f6O8�Df�kp\�NN����CBP�l h���?��]�KT�O$*��h%K���x��>�Z����;��y�v�h�A��MOR�������n�$�!M&�I,��`�oHd�~��c��[��)���3	?����m����>n�g�8�\btЂ�m����	���Y=���/~T���IN�`E5��`�{"S3����X_J�k �Wy�_?V��2Ot�^h����7~��ԡ�J�� �%����z�6�. �ѡ�@��B�WL@͑��]������3:�ؼ��M.�����!��R�f �x��X�o��n�<�@n�~�;v�G���]hT]4���o��m�w�	vy7���[Uiƴ�uRט�1�i��Чr��\�/f�0Ov|�t�*@m�� Cٱ����B�5�Cpfˉ]Q���n{n��Y0��&4��<����At����]y�_��i�ӌn����i�����4�>B��=N"�PLؠGj6A�Bj�5�Ea�˺��h�o8������L�e�+���n{7)�R��,n-���[`tH[�r;P��
���MsQdBMu='eDC�]Lf��~���������܍ͺ2<A�-6f�7��Ɨ���y�E���I ^wBO�����u�����A����r��ˈ|���Br���c�*D��* �?E�v�Y9��-��2J/u��Y�C�E��Ǚ�9k �"�3�)��y���'O�]j8P�Z�)久Z��w�#<��m�?ܢ���������'D�Jny35�#�0:�;4�)��S���^���⩂ct�f�@#�`�Y�7J���e�<ѳ�q0�����*�ȉ�q��Qm�hg��#3�2��6	�Y"�*6�	4j�O՟Fu}�l귌|edE��y?��T�5�)F����S:2<̟��X�?���#�6vdw�͝$ wdH;3�8cD�ǜ�Kuߒ�s �3�<��G�77��A����`E� �6����G����
�V���j���� H�j��Mck�Q?��C$I5<�f����쑳��j�
���<֬�xƍzM�N�N�'1�\<s�{��옵KRM�@J)����'1:5�sWI�;z��1N�b�ה�fI�<���HxGמ\��Ь$=E���h-d��Ĕ�.s�+��G���6��o��B��	�"���I.��Av�e��t{=�A�<�ٹ˄�]H:?�&�"�P�J�Je|���#�Ф�Bǫ�rom��f1��^�-�֓��<y7	�|8q,��ҖEsM�¶ o����<!F]2���O����$8������T���k�^��:P��I��y�niGi�-:�=	p�ލFT�����ܹ
�?��*-���n_?�?2O�U(�X4)��f�;_��Z� ���B���*Mo2j�B���v�+�Z��!t�	7̻\�c�pN�0���r7m��&ll�q�-'7Ƹ��pY8��E�*�u?H̴nZ�k7)k�!���-���wm��Ǎ��ic 8%�Q&A2�'2��r;��V�v8�ҫ9J'� q�o�If�c��E��V�cڋ\�$h}-@<C�����7ҝ0��G�3�u�R���'bib��I
U:�*0:H/t6�?�k������K]��w-��K=�צ����f��8���R�7���f�Y3O֫�ݻ`Bl���;:�zuw[��f��˝�q�[A܇$�z]�o��?+�Iv���Z�"HTد�!�]��װ�iX�bth# 
�|J73-�������\Zɑ!OO}�I,R�1-��J/z�d 8�D��69A�h�A�!k1���pm�F�eޕ��&���?&1��I*t���n(���Ǥl�i����������w �t�9f-c�:����ih'����Df��.ռ�
Gz�r�I 4*�������K扽���B���O��BȜ�P��'m �L1Odt�]�R�b�rM��C�2�� ��C>��p����I��8�R�5Mm����]{1V�A�._8�IR�⅛���2"i)�����P�O6c�S7s���P;GAk\�f�"S���էX��*h�Wq�e���Cl��md\ct��1�Bli�3���y"�����D�#
���8��Q��Z��Ͷ-s��F
%���An���Nh��rA�׀)M�K��~3!�2�z��\���y�a�R����l#s�+M;�Y9�15헝�����J���vgۈ#�R�v�"T�I�H���96���CW|�K�Z�_ź\���_v�=��.\��pIz$\"ȕv��> G�<��\׆�o�4�xI�d �  k��>$�]lV��~��Y����g�pm���c0����B��D��ů8�qt`\8�,��Q�[A�˒t�0�CO��N8�,4F����~ff���D�G||�T�j�RZc�k�q��V���)��g��Μ �)+ڠ �[��Բ�V�v�.h?M�@���D�O� r���U1*Ws �$�a��Qk�@B -�}z8T[��rt����)�w�!� �'5�%]�z��~��(��!���ω�w
$9-<%h�@FjpH��p��l�9����#���v�Rt�D2�%�t�����c9������-��=�����E�����9���u�S	�vk=>;O�F4»�@�So�F�j�@��ߊ��E�,��C����%��̆�e6�Ǫ�i�Â^% ��h��s�@�Jz\=y��������D�s6��.q�U{u��{Z���� ��ቼ M����o���Z-?���y�g
��~(P�ctШM�~U~},�{��(v��̓���n�q���)�y�����艼��Yc��$d�e3�O�R���	ڵ2|4|Z�
�iG49fe��I���yቼ ��U���B"AV	�>�$5q��� ӢCli�(4& �/G��vc����,qW����;��Hi�]���[�
wS|"��Ծ�]��n!��M�Btxa�)�<�~����M�d�S�����rN�:co�i�i�&XL�7��rUmw�c��Y|�:��'���Oڧt�7��$�3]��9a�])�P$Zy��R-$4Zyr0��%H���i� �9�DF�ʅ����0E�2E�zHh�pv�3�)I{UHh��y��\n�:�����{��N�'r�Y��Qp���#G����@/�$�s��.i\�P��Ș'2��Z9K!w������&��@"C�*I��֕q�����*�$�����䬉!�gf~���"�h� �Ф��˺c��;���i�WfAf�'2ZՆ.�<��W�����R��2�<���cSx����n	�v6�Hg�[0��2Y�K�e�#��6�rt��)Y�v��!����i�������+�~u;[�~¶�ѧ�ͯ�~�6u�K�}���}a0;�G2;�-�=s���%1��љm����
}���>�c�xg��ݗzN{���h_�^3�R��$�M����7��:��/_���8�ҹ�B`t�wh�i4���ޕ[tǲ�}N*ET�t7wư:v�K��a9Qs������-��*��G�6uh{#X0��1Ч�vY�M����[�qc��� ��FEnGxĴ�=x�4�o�O�����
~��gi>?/r�"x�rL'��.����#��(�^;��y<ʕ?��h:7܏D7�������BIЪ$�@�
�Y��uM�R�v�-#$͐�R�` �#(�q�7�f(H��0��D��4錓�)4CvL�̳�D�\�t��:��cu,��^M�/�>9�%��KSh�\��Mt-$r�J�3:�O��ZS�1H�b�F�%i��;͓H�b����4e��@�[ȶ�@UJ�H��B3��{���@J�ۅF��w����'2����<eR�4C yO���h���1J{���	9.=��P:Y�!� G��oy�"CZ�_
�Bp!�'�h��J�!C���^��D��JM�Y�[�ۊ�Snq���'�@�JI��{6u,5��ȢC$C�b�~��������twL�.Tj�A�!e���BR e���ܳ��:�
���CNH��@I���^�t�S�kb�����?M{HJ�����/Ŕ��2��h�+@�*=cwҮ�v������$��8PUe )���g���@<���4��(�U�3녱w)�P��7�h!��`Uvf���&�	F���BF���$J�mD:������6���(��'���<C�k�GI������x��>]	�>�4�ҬR�d�<���B5嚽�h�]�ץ��#�|2�|�h~)@%�l~�ږ�ka�R�t����j�H&�����3�"��Yt�o�dE�� �	R�Y�hz��E	�TBN�ZK���k<'�ǝТ��Zt�4�k��j�� 3P3Ob�'�yR�̱�X�%$+Z�a !PB��g���S��&H�������d�̳|Z���Z�0:8�!��F����<��աKu��2t~E#� A��'�4C4���?��H4M3TL� 	��jF�]�z.}�_<v��>k ��}6��Ӫ�"�� �5�ӽ�@2E�L>#� �i(4FI�Z>��	�Y���6�����n�SH��y;:��v-�i&@�
<�镒S����7k!��<tL.��N��I5Ϳ H*�<��j5sqD�Y����2T��c� H�:�oX��@6�w���4� �$�D�[VSt���T ITF��8`S��R��R$U�<��u3��1scΎŘi'c�@��`�x".y,��m���$�c/{��iN� �D�D���ǎj�I�ۖ��D�H�-�X�8�mhk�� IT��q�L�P��tK0�D�G��K�i*Z��D5>��!����+,���?[�,�D�FZ;�
��E��&@����R�t	w\�b���4@�@�4�TG�f���T3��HiA���$*�jD��r×bt�] J�	$QeT#2}���)B����1h�TBO��2w�
Joώ�CIך� $5ڎ�Wef��m����)2�B7f�RBfZН�@�5"ӭ��4C;m��cO��ޫ]�x�!y(��,@U�i1#>�����\�S�Bۚ���qp+T���N�>oGVz�8�FV�,|EG�_����6	_-��xf'��J��9h5N���ތ�zY������2����Z{��i���	���%F�;tDD]�ޗ����yrӧs�J4s�ّcNmU�����6��~Y�^g��}w^_��u�.����F5�{q�?|��w���q      �      x������ � �      O   
  x��Y�nI<W}�~ ���x�� s��C����,�p-���I�d�,�a�C�2�-�"J�<�/���9GZًҲ�P�)�Q�yN�-?~<��}���U�Q�I)gSks�p.����F^����ϖِ5V�T��b+���Q���Mυ��FSjCR�Rh�n(���~���q�� R��	�榹���T�ə�m�6�a-ݍh������?��D{���	W&�bǦh+@��$��B���q�~ĥ-ƨ-��J3Z
��}0j���;_�����"�Z��H���ت[�|OAZ'�4�D���j��ُ���^�x�����CoO�%��A����u���N�b���8�^�;f�FS���xWO�6�"d�#@��j����Rek�e���&�Z
�%�F��2ߑ�/�/��s^BL"��\�h��6
 ����H���L�Z��8��4���ў�.Q8^7�{��`-�b/�������x��=�������0��y���,;�׏�zS:X݋��tP�b��A(2���!�%<ON�PL���6�����:������V�9��URo�g9kr]�؎��؇?V��lo�4��fыS��^R��y>�2����v{���(����=�0�ʝ'�W�aT�A��C���"��d�fl��{LG���j��*`��٧;����c^<�#'������Gk�9b{���L�2�To�����%��W1qۃ{������#	�P��X�Y������ס�rE�44Wc� R Vc[��j6��_���?�-.���!I<���Vڊ6:	S����et��8Ƕ"�]z|M�Wv��6�F\HLj4�
��2�yyy����a�c&X'�]D5ۘ|��u8����0dI1���t�X��9����?��<���Ž�J[���|�>ST�)�wSch���S4>}~���D��5|��t�ڹH��u�:^ik�Գ�N�T��#	j!��;>�b�ydu�;�x	P.:�n�m��Mr*un��O�a-�Ş�������䪦�P��7�Bw�l�� ����G�u����Y��w���f%�M������sw ��
�v'eX�W�W�Ul^��F��b��XQ��-�F�Dފ:�;jzZ�1��h���Q��s�n-���Dc�@��Y84ӓ�A pכ�������~Q'q]�[i��{�-8��ws���5�S��8���R����b���HI��"�[iS)R�%�1��E�va�m Sq�/�NX_��Ӓ0�����c��yߡ�4@I�F�S���,Cb9)f�Z���kB;�Iփ`��>*9�5�%���۽��C�E��^����������O���������ן�N�a�L�b�hyﺕ��fr���Hj�$q?�&U�w�W�p�x����5߱SI�RZ����a4��y�^Ϟ��[yk������H���&B
�I��Р��M���/*'�]���*o��9�
DQ�
k�m%tRK��,�.�q�oG��,�H 9[b�0�� <�%�u�{�h���7�x)����}�Sm���Xx����u�l��I�N�L�t0]��dz��g�%����k��0]{��S�b�l�&���c�(��#a����<���'WS`Ҋ�忽|�8x��p��ٹ.��iTТ�V�k"��¼�B#���L�ݞ�����~������6|K�M��ҹp=�n�����������M[����*oR��������!3>2c��-�F��BX0{��tY���n�U6F����` ��ͬ���@��%qs]�K�?Z"z�H�b�nT$����Op����<6IŒK)W���M�E�Iۃ��\V�x�*7)&���v%F-53���3It�����ꐯ2�W��~���n�7�"chV���I�`OJ&:D!;3��������W��t�;�)g�U�<s녊����j�pG�Q�����A��ހ�-:ڋ��F�I�+y�f�tZ����7�X2�-�M��7�O{-~9��������F���b�� �(g�I�dڈ�`͊�;H�B{nS�b�n�Fox[�@��ԗP�[9�XEc��x�1�������q)������HK�ؠ�)��k�׺�J�P�]�Z��:,�H	}W�%��	G�d	.�M篥~�.Ky�n�M�J:P7�ir}G�b��]\ɖ����#g?�8�]�1��������@���r'&�
�`���nBs4��?%�^l��� ��-Ʉ��S��	�|T�:�������z�tW�Lc��b���м�=٘��7�ҾY�#��,��ƒ�i��e�r�1����<=e��|��=WFZ��h+���n����ëb7�c|ZD��՛N��{��~�V�-�1�4�LK��;�a?�βs'�ggaқ�Z*Z|%�Z+�a��iH�`L�+Y{.��b��h��A��@����@�t�M�d[��Q���=<S\_�9�V��b�ζ���1�K��א����y����ԯ�*�p�e�b������=<�         c  x�m�ᒚ0�_�"/�N�n�ݟ��T���ٙNĬR�P�ڧo�������I�	���0�u-��כ��Y!h)�����n/L�ě��;O\/s�n�E*Y�u�W��`A�&�n�Y� _)*�`�X�#�mt�HWɲ�T�r�wkH#����Fg��L�=�4���m(�k]`���> �> s�]p�.8l�(h!O�>����oȒ��g���e-�y'Ɩ�<zv�wd\ɿ��e��@F�0j7H�7.c����v��n��/϶��`d����[�L!�YD�c��<,�b��0�ç^��w5�k~C��B�	\����|���Ċ����0a��o��`W�Ԭ���B�e��F�c�J��`π�O!;ׁ����T�d[H�sc��3���i����<"�$���	.��9�z.�"!�
lk>���k����4f0^��%�`���i�[B�#4�'�_c�L�a�_�:Ҋ�Z�I��˞Hd�8���̺m�ن��BlU�o���S���L����wg,����(�it������w�`�jC8�����4�Wu�R_N��A@N��Z|`'̋��%:L/+�^���[A���|� ��ʬ      ;      x������ � �      9      x������ � �      g   q   x�����0�N�@��B.\��:��?!�ϙ�-kd�cd[V�A�`o۷�{��_�>D���ei1���x������8��_��=��j�c3ǰr��-�*I��:Ϩs�RJ'��hi      3   S  x���M�$G��5���H
ŏji�־�lB�7fL3�/�c;���'IӨ;�O��$��~�������ju��ۤ;Ȧ;5߅�U�{Z�Ͽ����������{趖�J�du0�$NuK��j�o�|���˝�M��_��UV%v��Q�����a�t�C:����F7�f�V;�zԼ��V����{Z�W���V�����F�u�a�m֛�RJ�J����'y;��][Y�p&	�ZSjE�N��X�KyS�UJ��R��]�������ԕ5z���O��}�;��3<�Q�FK�A"��A���[�|����z�d��N,�QY�����
������̞!]�#A�(��H���2��'�����9�XpS"J��Ieh�=e��h��囲������6#�n*�=�A�+iol����z��לB�+^[�M	�YVM=b����cg�r&O���nP���C6)s_�R�.�]�GV��XϐΨA�V�C��Mo����ߴb'��Gụ{n�����_\�m�J-A�pe���B����|�Z�>x2�]A���&�|D��k��蚞��#�{jw�Q�|��6��[�偆���}Rɹ�G���ո��F:Sz����)9�y�|���~���.�rVҸ�=i��hh���*R��0�=�d+��P���Z��KW�
:�g���m���]���?j��FfT6�q�M=�6�����x:4r2���(?Ƴ�D��s����<�/wnc�˴�Z����9�@(�b��P4�X�vW�K�:f_·��c
g٪Z�W��ȝsԉ#T�1�����Zޱ��/�i2/��a�<���Ư1��L�Coߨ�5v���\k�4a�T���&�7��f�2˗\�wŽ0�������B}�ڛ�U3��o����	��a�B c�C����~a l��tT?1���F;��9;VSƟ1�Š"�7��l�=�_�<����<�]��mjSA���a�I���
�N��&�
nG��uK�ƲZ��6�byw�	|�]�.���B[7�f���x�{�3��S꩙rZ��0��a 4Ւ'� ��5K����wX-cg�O�}���|o�         e  x�m��n�0Eד��ahIY6jE�
��n�8�"/�Q���c���w2G�ѽ&��_ڗR������7O�����/������[3a)���2�A����e��{������c�kl |+�Z'�ժ�-���!O�Ii֍�Ü�����3pN;}�[9�̃e��-�BL��
ϐ�Q���8N�}��fK���T7t�7_y:H��Ȝ6�q��S�s\����9�&�#��(d��c'���
�I���\ϩ�hǩ*$��d`~��3�����՝!A|ֳ+ �}������v{�jtE	��$��N�󁶺Úk/V�o+=:��DxdB�6C�6�r�~E��2�      �   �  x������8��^�۟��I�$̄�" �7��W�	�m2�dV��R��q��e�/ʅ*E^
¯�+�}]�uy���O�ʾ�q(�jw���<R��+�o��Uͩ>��t;��o�����y����:��~_@��uˤITB/��I�]��P߄���99^���.x���R��ć�R��n���,����s����O�I�ק�=�C�b,�F�s��}�g<�E~S�2���aR�/��}׎}�&.c�̵&=c禭%��b��C�V���8$gj������n@�{�T��kRVb.ա��0�X�(p@�e��yq�j�f&YL�}w�Tm>ڲ��tHN�S�]�@�X��*���wh���>�`��2i!�:���=LR�(��a��2�F��^�zm�7�{�]/�G}l���)���m3J)]4��\R�Z~�T⠒~��������M��9�椿��!dS�����߇�O�M?µڥ�4)�|/�4~�&⦛ �?3"�ĵ�/��db2�Aɱ},a�"�:`�<- � F�I�	��Q�xZ�AQ1�I�95{�A8/�Jǃ������}��*�ٱ�N�1 lh���n�݃q�k��s!�0�k�CJe�� �7���Je*��XXw��X�!��Ž����Χ�^���ɮ��m&�ݵ/�u��г�K�dp
�#�����^���[��X��|��[�X]OM�>�u�L,����&.P�� ���+��}>2��T�|�L������M�PEL�V��҃�d:0|����u�j�|N�O5�zR�ۣ�SYM?��ִ���k���f^�kF<�< (<#7y��y���ڜ�ac۞�}�A�����ƛ{86o�����}�*a"i��6�i��;-(
�vkt��y�'|�m��n��z�6����m]�.�3e60�M��2�'�Z�%��
��Z�!Sb5SJ���L Mn��
LP�� ���:�r�����k�"A~�ɬ��d��A5^�ATw�����A�T
m���ڥtt�����ޜ ��TV��@��T���=�y9�i?���.�(X�[�� ,�Aܱ�ٍ��;��3ļ/hn, �������z�
@*����icD�`�1��a �a�zgZ=��� ��c����!dcH92	�]"N�i�E��\����K�LL��x>���]����Od��DwL��&Jj~���T}�%'�;_"��b��Y������{s���%�\�y<@%���x�O-.�">G��J��Ez��Z<>J�\��z,��끎n�ˍ8���/z�&����Y�}�������'����n����xL�J�>!����}���?z����@k�� �!��5�������@��E�O�f�?lfBw�_i'�aʡ?�.��ɐrhrny%�DGL_���RJ�����{��H���+˲����      �   [   x�3����K�52�L�-�ɯLM��ur�5244404004�t�I%f�&�(�����drr�X�)[X�`����� j��      5     x�Ք�n1�뙧�2��$r� A������v�>\{�Þ.\$��_���Oc���]F	�s؍B5BT�Ac�-�i�Pn�ȃh��F4Ӕ	$� ��\�w�I���r���>8�N�b�n�Ŧn;�C�5���|���\�z��o�nse.̝N~z��ǰ+���5�%m',�5�
��\��iP��l�!��a�O�Z,yĒ�BX�[��x�j��T�|020��V���Jkê�� %���A �h�H���E'����z"t��/�nn���s�.u��z�:�4�V(k/k�%mNO��VZ���CFJܼ�Jq�`�g����m.$��O�[��9��gض�_���@���^���m4j��P;Ք�*/��+��2�ZdUJ}�7����zB�\ZcD���f��2�X��a[���AUȏQ�雭���f˜�F�K����� AF�B�� �%����+X�Ղ?Cյ}���6����E�7�jϩ�{T+�� =�A��� �+���qI������;yƭR      /   �  x��XK�[G\�;�/���&��Z��@6��`l���7�Hc���ci�E=Al�b���F��D=���*ԋ)�*�j.��/�h�5���_���1� 	"TH"y^��&i�B^و׮s�(�����P?�?�o��pM�"~8�2��R��n}x��#i�)fk�s�����. +�Z�;�{<L�O�N���.�69r��Z�F�МI��2%k�K�X���l6��t�8#}7�d��|�'|M_�"5f�7�D.=�Q��6G�wv&�t��s���`67� ��Ĩ��8o/����Zpj,M;~Vi)�J�5�)ɚ~���͇.��=rP\<��d;΅���r���z�ٵ8H�W�&$ ����_$��u��~��5G�zfe���(�JC�bMZ�Y;
�kx��f� �/�`���ȁp��)�5��ơ�O�tG�f� ��,|����>ȧ��!t˃��c <eG[��z��i��>�w!�"�b�����#j����e����P�n�{�'ʑ���ޅ�l`���m%(e+\��7���-b<h~�'8��!��"�C�= �c�Ķ���|������O¦�b<��G��,!GJ1�!p����{^Q{RnD��B|���NV1�9+��^7��&��\�k��q@��*&�PI8y��+v�P��p0�=h��R*�k��2x�l�ҙp��������rb�f_{EԶ(�*c�:)p��鈱@���
{��������B�T�)�R3�f,X�g�`��٥��'��8mRԄNՉ��C��r�(����Hָ8��A��N�����k��]�$����R,n|r��km�3��-.'�֠����5;?o�	�xr�ap�� O���A'�cùNP���d�Y�ZL��ah6��h̅�w��"�]����v��p?Mԇj�ټ���N���K����E]���kL�_D�v����E�sd�	o�	z����m|2�w����D4c�q�����ۘЕ+���4v�m7��%w�!R��~j� c?s�iHt,+������fM��-�嵇�%�L�%]�mrr�s5lA�Xq�:쯔X�rd��[��n��/�699�ֱ���*��Q�%�"�{3��նõI8���K�MN�1����^lW�P�O�@�8B
i�t�N��0� ��z���:!>{��`fF�#�u����k8��Փ��m�7�rf���m���m���S�6      7     x�m�Kj1@�3��T<��f�E������!i��I	�4��O<����G��c��pr�J��$�`Yj��\Ӭ�n��r�� �DE
�Qh�b��&[�1��i{}������ .ȏ؈��θ�Z
�x�����jI�T�O��eh�<�؄����,��Ksse�,�v��~�գ�g;|��q�_��:�/�wI��a�$\8�t�_L)�2�Z(�1C�s)���q>��d�� �H�A��@4Km�����v)}���i��dI�����q ��      1   �  x�͗Ko\7��s��ݰ�(R�f4�&E��=�A�1~4�/oRמ�k�Nb��a�+�s)^m/�._mw��C͐F���!��cE��%��)wc�������]��@H	ȃ��I5���n�f�N�5�+��=��M?�Գe��\}����ts�����6��4�=�V�����c��˫7��)R��q���]G�9[ύ J5@H�%��[Ϋ�P7��V~�i�8���h�y�q�6��__A/��	���rq@QQ�H�Vf���H>����6��ق[�A��B���'��뻕ݻ��$�CșR_\n~��P�؅JV����(��G�
�|�1&.^!�6�d�l�J�{9�����\��D\(�
W;L�)UH��S:a��8��Doi@,��!`*M�Si��Ql�+������4�&����T��2ږ��U��2��qR8t�G���8���y˔�p��!����ⶎ#(-]|�$-{!~��C9�O��c�k�X���ȑso��룷���C\�ޕ\J}�����54'��y�~ӑ���닋��j	�Rm2B�!��*6�S'{D�5�b��J),G� j,=UBji�VR-"��U���q��~�=k_u�p��ɛ���'2ɢ�J��:b��#��fk�5�h���]w1{������M����~Κ� �yS���3{�8�"#�r��V(���-�Y����ԇ�),�����i�a�69�����pws���P�sȤ�l�,0������P�kY�M�|��Qz�ƞf�$�g��OJ�c�y����Ҩ�Bxf!����9���%[��@RMP�Z��J�m�j+�fk��XO6Ve�h���<i1>�$v{3�]mrr�J ���{��B�M9�cm�nQ�?��TcNTA�K�(`I��Z�	�b_ �K�Ʌ=�i�p	���<FISK���(Y�&.��`�ٞ�l��6���6Q>E1�䍝���5�&�?䚃GA����{P��s�Q4�x��Y�I�N��ކ������B1�ֲ�B�q�+;63Jj��+���ʐ����RO����vo0�j��<���y���5cʥ5��Vk�-�l���d,�b���QY(��k�K��5#���k֠8�mӰ�挑�Ƽ�����f��
��z3��ϒi�	l���6g>����wW�hFӲ����nN	�@���o��j�v�zRKy��	=軴v�w���M�8M���      +   X  x����j1Fמ��(H�d˳d��E��xlM	䏴)���{�"L��M�3!}�����+lo�ݟ��
p+݊Y��'ɕ�*)P���=F.�_������5!2 3*�qI�����0^�|Ow�m}��a�OW����uƖ8�P@˛�F�l;d�5�B��7u��h	�NB�(M$4|��O_�$�m�i�2c�|�8O��BQ\��~�B���b�[�-��P\�hqf��΢��\M�R]XIP���US��E��<��ڿ2)+�|Ɩ475��X@JQ(X�d�zs���1��-�7�%�~Z[A6k-fP�ޓ�����������3��].����       �      x������ � �      K   W   x�3���O���,N,�Df��q��*�YZ�Xbs�.�L�2��,��K�N�K��1�L1�P04�24"�bSb���� K3$P      a      x����J�0���S�Ff&I��(
��7o{im���B����Ulc7"�0�1���A02!p��Xw�n��\�b]��t$O���#F��>�i$����2�M��Н�Ý��O���?/Q��|�]�I�k+J-
Sd-(��)̘Q��Z<ƹ��2;^k�5�4�F�����1��TA���
L�-�X4MS�YοnL��l�ڍ%ڒ}�I�+&8�C�WC;7d�$�H����TӯLRd�>;���H)?�E��      �      x������ � �      -   R   x�3�,�,)�500�L�-�ɯLM��u�q�5240�4����K�52�t,*O�K�4202�5��52R00�26�21�&����� j��      �   U   x�3�,-�L�MI�I���NL*-H,I��t���|CS ���CF\FȚJsK��l#���!�rJ��z|�LN�Z�1z\\\ .�      �   b  x��Y[W�8~6�BO�`6�=�(�%Khy�b��ı����_�#ɒƒ��S���ƶ��E���ϊ���ԧ�.N�̩X�	˷�UCH�Bx��g��`?����s�r�;�&��(Ni���R���Q�g{�K��3yTe<@�EQ^�Z%q����}���k��M�+�$3�$�dJ�V*gC�*3�%,,�8���[$P��q��OhZ:P�b�`l��U����/�o�`@eY�1�>Ϣ*�J�K��@F����7��a91��҇#��N�-.ȳ�i_����=�a�޴^�)_i��g��`)�j��c���ckS�`���E��T��]D�	��8��Y
����,��\��j�"����qE�u�j�j�c���+؄�= ��!>A�n?���W�Đ0�K�Ydi�o��2�"-Ѹ �b�88�`K֬,y��=�j�45l�P;{���%Ij|�#]đ(����@KƙY�[�F��!�H#s I��Gb�ݠa���-QuC�j������8�#��/鎟��&ϵ@����Ֆ���Y��S�r��N�l[�~DK�C"dE!Q %7 �Q�������]$�M�J��V�{
���u��=ą�t�Rx5�Tq0Ă׊%��_a�p�7hZ+Æ���(���%�
"�<�N����J�/�r�t��J3Cy͌d�c��n�H.�	�����-[U���k�Q�L>ɦ��QuI�X���;�G\�|���o�)�wb��B1k���H����Q�G�S}��@�9;�������nZ�qk�P���Lhȉ��O?;mA���v��}"���Տ��i�6YU0�؞�ጯ��z���6���Z]�7{:��"�~ՠ���u�����=쉷��^_�"p�k+8Pk��70�����q�SD\HP���b:���a�^��~Ď8�*��B#g	ކ{�!O��~?Ĝ�������<����4��q�k�@,⒨�f�{Đ��w��<.?��FH�J�ш/I���C��޼^�m4đ�]e��/;�{-v�Uƚ*L�cA0bІ@���Z2�1bG��5���a������;�>�V�7ڪ塦D?h=DЭֻ7���ӏX�i䆯�e��bo?�y�(hA��f@2-Lc"�!ڍb�.Kc�Z���:�,��Zj)���)d�.ފ��S
7<O���C�������E�S�\뢂�x�(
�4"�D��V�Y�&n�>B��sF�݅L�����^�o7��
���XcĀ�[�-�=:i10�ӊ�X9e�k��!����qb��a���x`��%���xh���ʂ���E�0��D��a*�D�X1F�@N�[���V$~��'O:�$~��k��#^
�5N	f���Z%�%t%�B`
�A!��W���N�ʵ�&�GyF#Ef��ڥ'+.�흚 F���C�j)��:����s�5߉'C�rO��$�zQ/51IWw��OƮUcV��S���݌p*��I�>�'`gEEc(R��<���~)4d�4��k���"�a�����b���,�R���� nН9��%thGǩA�߄÷l��=p�Z��Az`I�$�E�4��T%}}UM��[�%����`VU�;�K�R���D�2Ι �3�hP;� ��`�?��#Zn�+��/<���z��>���p>���K�
�,Q���iItUॄ�Z�a�'��#��'�pi��_��cLC��U�v��˶Q5bƁn��8�_��|Ns<�U�F}\�lF�X!U����v����덿��h��.ᅋȵY�B�'�u,�q����Dxyȩ9Y��c^wj^��������Vo�A�aCM�E���E�Y�a�X�ژ� ���!�v���������      Q   �  x�}�펣 ��U�fçU.b���a
N�؏��f�~��'�&�}���0:��u���7"�o��qy��(et}`��Qc�+��C6�5���.1F� �
f��e��.Ũ�eT�� !�,5A"c��:�[7� em��Ba�2���TVJ*���k��7��	H���L�eB��.��F'ub����Q���.���Sg�QA�<[,a+#i�j{ ^K����x1�c�wF9�u���:?�~ ���I��(�V�k�7|��QV�e1υ]�){v�c�(zJ 9%0F9'��z��B�LK���Ni�����v(���$`���ɐ�8͚�/g'�;pZXbV���|��if�	��Y��w�����ĥ�g#$ʢ�_�}�Z�o�1��aիC�$,:��f����ǤF綕E��Ig-�ӣE�)Ӡ,�նGN3KʢY����`Y�%ɾ��;����h����pz&��Up��(��s���#�G豕/~J|�؍IW�,�GM���uw83���~���)���,��Vc���QHiCX%[��0������hMw�����z���-Q��>jo�yl�М��~J}U�$�!�����(�Q��lY�h�ԗ��S�v�{&�^BKB��sd`�����W��l      M   �  x��VKo�6>K�B�K���۶�X,�M��z�ER���I-���Zyȶ
Hf8�|�曇��pR6JA�^��@�$��YDّɽAԮ�\�J
��_i�Vf���J[Pt<�y�F�}��ͦt#m+M�fɯV��� `�9	�B/�7��'v���&�Q�@W߮^~�������{(h�R�R��$6
[���K~5?��)uI#TP��;+�d�D�9�:�4��PH ���ѕA�W����LKt�m���j=!��C�v9'>K ���h�����	�Y�ӶJa�+����b?�$C/�"%K6�mI/���ꂬ&��{�"J�DQx��1�� tL���Y��~��݇��ߍ�2����"��Y������_�4 XB�'bҔ>���f�JF�}8�&�Jy�T΃5�����he��tI��D��-KJ/������b���ɉ���e�:-��� r������v��S�sX_�>���6l�����!�p����N29� ��j�G���s��`i'�]"dcJ}����JJ��ү�s��w���&����8lF��w�a�8l�f?B�¾I���1�����Ꮍ~~5n�Rؕ��?�mvC�ذ��4|���&l�C�<ܱ�!��k'8��Կ�����F�r���;vQt -���yHX2
�gV�RWc�/�V덈4,W���3��|njN�咢	p�$Ww !Sp�r��e������i���|�<a_8!�^o�Ow��u��><�e���	}�j�-��� T)bt���18�tP�B #co��r�n�?ì�_�'��¶% ���P�p�SΖ�ì�&�E�� ;.�h�@�?*�/ǰ?T`q�8�<-֞;��6y1mܱ;�4������l�O����3L��a���]�;��������BC�������@Hg�;�Z����!��D�S�̣�/��{���K=�ƺ;Jnޤ�/W_������Ǉ�������b��Y<��{�j=	�B���ک^]�$zN��u���P���4S]Z�LW9]"�Nn�l��T�L/)[/2u�NeHs�ԽMF���n��\�_W'O�/�V �t��j=�����e���M)����`�ᅌg�ӧ��� �Ԝ��hN�U�6�K~��f/��w!�D�����6��5�q���c6��H�Dyw�E�e+ej�V�6��)����{9��ۖ)����o�������N      �   n   x�3�,J��L�����,�I����1~@�e���.�,.I�����H
K�s2�9��4D�	BAFf^J)���H�"$�JS29��$D��������RNo�$F��� &Y>X         :   x�3�,�O,.I-�5�5�4��44�4�2�4202�5��52P00�22�2�*����� ��      [     x����N�0���S��l�_�#�&q�K+BU��I)#N��^�ϩ��l;o7w
 � ��H!(2b� ��G?��=����xx��oWh�� ��ŭ�fIP�D���3Xr�����c���s牋���&++ڢ�kf��`���X.Ǣ9hB���
�1�z<+��ϡ0"e���,�/ve�����zg�B�O�I�m���Ҹ����pH��U/��\�s��X;�Y�������WG�
��MJ_�6�5X����Dw7R�/Xñ      G   �   x����j�0���S��َ�%����X�	�ҋ�y�IqGk��_�u+)��ׯI@�8�fk�<�� �3"	mN�z�wG�.8ԫ���Xk_�g��p�7?ru=A#��y������+�{hVy��J
��Z���xs@�A/�Ϙ3(+�:<�*�n"����1L$ZfZ�/��qr*�ۧ$��y��_oo+ۅ�0AaR���j�D6
?	SHmAХ��w�ͅ�T+���ME��	��         X   x�3�,.I,)-�-JML���1~@�e�JJ�tr�
���ӋR�9�4D�&��SQ�韧 cC���$q�8A�c���� h'-d         <   x�3�,��,��M,)���-����3B��? �2�(�!�!�Iɹ�NξP�=... 8��      !      x��}�r�H���+�����~�	���H��׬^��*����2+�m�~�c$<"(򊨙������X|?�f������������6Z����#��,�o��Ͽ�^����1�����������>��t[��bT՗`������_�����i������f\n��*�w妼���jQ.w�R�����O�@��<�A%���rz�
��� f
Z��c9�x��m2�]a��ן�����B�vz_/����K�8_���{	@v�����
ri��/7����\�0��y	�l`�4�,t�	�����y���G��%�X��r��7�q�Xnl�(��@'x#�-wr�c�,�̦���r{�RLɥ�2�>)#�oQ�Ċ���G�y���5��z�C8��}P>��ƨG�F�YPF(#1�kxϸ~�?�.��Fo!��
6�
v��}���ծ�2�a�4��?!�|B��QN��Ջ5�����QI�F�X�9 �]�[�1��^���b��u��?l@��!���-�R��JŤ� �p]�5k3nv�ô
*�P�kgȎ�cƘb�1h��W���e%�a���U8�TOՎJN�ذ,�����z���웅F����3ei��������w�24� 7S����
p�hm7��ty��� eC��>�Z��ZQv�?��eM�.'e� ��qY���`�p����.��	Sg19wN���߄7��h�<r�Q�췷`��s�����m�ڬ`���r�.�5��gɢ���)Q
r�,Aukc��d��3
��7�SD�k�>G�Ģ��ԍ$U�t��pi�����|o�@�%�{������l�X�B�.@'W�xv���c�b^	g��?�L�;�nh�ѸE��算J|R> ��������Yq�Ew��;�A��Ay��p��?��E5n��+j�2��ޖ�� ؗ�G�.n��E�7��R��L���G��A�{�^ܢ���� "w��������ٿ�N@ߵ�������P�,��p������t^�'6m 5�bko������g��G� 2j:7�e���9���e1���,�K[p�Š��v!]���NDo�� ��EXLM���]&�o6��M��C�����5�K��Y=�|��$�Q��nP��(��L�!��(
O\R�>���q�O#���Ԑ� L[
��_�3R]�X���k�����s`=A���6<�PN���Y]��m�_yvd*>�����'<~�g_��"�hs�C�>Fi/Jؒ��㊌����m7x{cܗ&%x֮��LP����FϾIh���e*Q>��T=�G�1���)y�UL��4(#P=��<@�e^L[z��ʚ(�^lу��9.+<�AE�gTP�L�3��;%�f����i:X�]�9��Mi���k�<�S��rR��<`;�<�kS���׉�b��a`2�������BE�[L�G���ܤ��b��uG�~v��-�pg�@��~_,q�f$W�$�b�=��=f\m�I	N����&-ޙԇj^m���=���aTyrl�K؅��,p�����&<2�6h��kgfE:�L�Y��p��=.0r�%;yj����m�9Y��b��Vtٔ�	F75�:��i��YP-v!��n #bBq8$���1+�c#l��Φ���w��`D{6J>��^D^'�(S�'�y�)cmn^�S����w�JKq�Z���`D�1�<ο�; �:m�Z<�E9QۄE��`Qn+������~|�Z�H�>�CQ� �)'������Q!S,�.����!����FrO��2Ʃ��-��|�c]�S/-ފ}�O-��{��\fo��6X��zW�����-�.�M���8��G:uYl��L\j&X��=�MaAA���ZO��c冭�9&��u=;�1�Eo��z���G;�w4�{{��q�*ev8�/�N�Xӏ���� ��aQ���R>���{����ҙ�ع*�V�cyԋ]�����&�O����H9������zSb�<Wr�l1�X=a��܊�Ѝ���Ƶ�[���3���D9�RD����Y�@Ds��������Q=PF
���O�'�T�N�X�(�0̿�a(GJ�-��Qv_�(Z�"8ww��t#�#�Y���|}}�_*�
����S8Y}_5'����^T���[ƔQ���sH��fT�������rG�F��%O13�V8��[�O���	�ᨑoE~@�|�c!�=���U��ٰ֞�"�/='M�����puw�cK��'�؏���{,�~������y������u��"*��Of.��r�l���ch��jQ�����Qy����9���phC)�{8�|���DN|��Z�bfF[o4:�6T�kH�Xa�<�T�k8�XA����u{|�����.��{bF PXb��Q�.E.��8
�ȥ��- ��Hr�� Las�<�,��0���Q5���u ,j<@�ԧ c鮳��F�|�;0h���J�����>��&�B,5��6�ƕ(,������F�>s��6^�0�#,�11�a�,(%��6��S�O���1a�@I,��P}*ɀ�6R������=�r~fam���YH�W��f��`J����=��jf�s_���Y���-�`B�u˪��>�:ff!�������uj�q Ԋ�Xo� K�b���V�(�
�WM�x�3�^�9s�Xko���Z�|�U�j]�y�)}tq�o���s�b3�����H���GRLĪ�r��U�hE����)료w�Ҳݣ,ne�'��,��!�Y/\���C�`f/���5�(���^�O����T��ضbx �)���	�k	�A�O&��>η�t:�n%�a�_�
��&�{M����H���]Z	q�)ES4p��;��Ld���cY�7�Qʾ��FJ�I���#v�7љ�VBU��+�J��=��w�EI�Y��?W�����������}�xR��ѹ�/�㲩䡄j}�k�r�`�./x�"�����(]��I�X:>˲��������\��,fܭ�͆Ɓ
3�N9��}��[ h��w���Ȗ�P��T	�걱*�rA��U��|�2=J f!�[Ds5����Z	Y���/EQ+�"�C`\���Y�mP�JW�e�"T�&[x{ը�U�>���T_}tj�?/�h���j,WA�he�\�KgHf�R_�����Z�{��J��&�G��:��U}u��F��l�(�����e6���(���>�Փ�9,�OBj��~�{�~R�zH�V�ǹ���G�����¾���Ƕ�;¯�0�o�*D&a��4gͮ�]�Pb�>������j�_9Ra:(��<h+�\bU���;k�p�"o8G	���R���F6��F���2c�����,F�.u�XGi4�/GĻsǙ0$E�N�Z�V�@H��"��S��_�zV5�Q�D}����<a_��\�"*.�KJ����E� K�Db�%hEd&����6�1����2L��<���@G�|�#�k�dP�}�&_|�aǘ�)|����b���l��5� H�|��a!Ed��,�=:���Sf�P�"N��G�)��k)ܮڽ=z����H��Ң�1�/vX��S�M6a!��~� %&�%x��jQϿ�#���e3�1'�7c�6A��2Ŗ����0���`ݗ�P\�,�NB�B�)��-��զ�M���{] �v�RB(,hs$ˆ��Y>,�6�,/*�F���}砤�#�_��t�r��q%X4�{�^#m�^e3u��8=OM�vj	
�<!2��{�ǧ�X\�k���6��e=k��|꼱$�n��c� �E�jۊ��1V�v+4��Ƨz*k���[^D�W��b��2��-0��ou�(��S܊t0��6?�;ԫ9F�_�*�A	�b*��u��6ja^�J�<?��ݮƫ�(�>�=�gN�LG�4�̍A�1P��=t�a��f���騳2N{�?"P��΃(��0��|�@�b:&P����(�    ��>�� �>��u�>.3���}��F�9�Go֐��D�����б������в��(�g5!���6�ƚN\'Dc-��ϦPT����a}|kW�!
�c_>Q��1��Qpfu@B�bL7ӵD+�!�RЩ�O"[�q�����~1����]ǌj��kI/�##�j�(3��O��n,���1���D�N�5̙h���eǖ�E5�Mw������/�?�˲�x[/��w��}�k���q�������6
hE�z�d5[Cs���4��T�\W_�V�G���},m������s�+A�Dj>�#q�������5�k���}Tn��!���}�n����ԩ��1����T�����}Tm�W?�V��\���VA���B+���-�>��%�)%���J�vrZ�GN��#��o���{=���w�J��48���3l���_��gJ/'���}y.����{���l"q�)���c��=ĳN1�q�fL����
b�N�rǢ���P�3���m��=ܽM�p���Ƞk��	�
��$�B=߁�Y�0�?C�[v�q*>øZV��o�9��>�	�6A.�G+f��ek���# ��K��L�(0�8�3��>B�~��U�Q	h��ќ
զ�L�␿*"��b�x��B�{y���.Ka,��(�8��#8�b��s�K:|>%!�).��^��s�Q܇Z�`s(f:ΨGM�-���pO�7�)�:����D��ѹ�y�Ҽ��>D�L1ԯ�����b�;�=�"?��#�x�=kZ�ղ����a��QaG������z��Q�?��%d��>a�-�c n���~~"���jg���N$}|�0<�Մ�r���:u)!�^�M?�є��^��N�>]n��ɴ�e[�˧������ꍉ�Hڄ���Zk����HQ\w�TB�U	���ƭc����`�~NȔ==����Qۯ�~R,v|�_�f�fD ^YR�5��!$E]�4�%���ڠ�긖�	�X%(Ơ�RK�4nsT�)�Z)�c�>���񎜸i[8�|)� ��eȗ@-��Z9��>�O�]�'�P?���HLXݜ�����z=�����-���h} �8E/�����-O�s���)�k���.2K7�fk��Tf�=�C��ny}�G�U�2��[���,���vwP�����ك�[x�Wv�,����nő���R�{)��K���T�2��y�M���J�rM�������!\�)B�',�J�쉓�"Wv�(��P+�齀8EXܤ[�^)�(�q��J4N�pڶ��b�8�W@M`�w��U1Q�D���f<_��4'�_�`H�%qQ,{�.V�O#$�^��n��~ɺ8էb���:\��F���c���VBע�a������b�a���W���j��n�p�cw5@ܫېr�m�#��~k��YsPbWhZ�p�2Bwy��n�t��������?ea����p�?ӕD�-�]��h�Hq��~nb�#ϱ�C�]}�aN��B�������M?,utB��*1�rY�;''h��)���)��z(�	���z+�Kal�e��yJ|<`��B��z��е���Ì;8Y���f[�W���� �[������M�X0�?0g��<��_R$s��&=Q�y9����^Q����g�H��+���v�J��!~|+D��0(���1>
��.^
� K6}b���b��
�;2I�'�g�(>�YTE�s���ȣ\kS����Je�N��|�V7J��{s�\f��{1`D����6Ew{8Y�� s��]��Ď�����"v�ga"��}��+"xޟ�D�{0Q_D��C�C����}�Q]"��"He��h����He'�R�ͦw&��ˬP8 �Ǵ��[��{T�������n�8]w����<���Rf�����%�5�� N+�8+��偩]O7Xq�ۺ'7>"h��(���b�|�%���@܈z������8��a�'��E����n�cn}���?�o�JD�N������M(�g�,�x��Lk1:~f�!�	���SlզH�x}.���WE�;�U�,l��̞uW"2ZO�W$�Y�Vq* GJ��N�R0)1i���G7x�Xn�P�#�o�m%pH���#@K"�����n�5����\��Y!��Y��E�b�'p��5<�ŭf�En1$W�K�!��ST��Ar"��Z�qɬ�`=��E`�~`��&o����]��K�e�8Ao�^�GfD0�����C���%���0� "H�b��]!�qpɿ^�ܒ���� ��YܭF�/�9"h�CBh1��8!����`�ƫ���)��4����ʪMe>�5`ZI��g=�6�}�P-����*�������v�9Lߜp6a �X������w�`����&��~�2f���w��C���_V�z[�5!8;�C��8��3���آͽ�"�:Y����}0�h[��SJ���v"��. �����QQN��M��h�����8i+4,���$	����,���?(ߓe���Fč�#��(Dz g����@A��t�uA����=�C�U��T�̤>�!����������!zh��b-/�ZN6�����D?���79CN��0=2YRL�ܔ����:�j<����D��呣���O
5�qͺ�"���Ɉ��@ܨl��͹1;A�Gh�J�n�2��<�p/^��Vb
ռ�m�μ�""���uy6)v�sN�K����p��+��k���8�j+�\�E�R̸�|]ޙ$S���J<J"H����K��s��Y{{_[��{���Z;�7BD1���^G���@7��t��7��U������������Z�����bQ�))��y�֪R����L�Lp��b;<ReR������<洁��+aWI�A)�`ۚQk���~[��]��ua���@Y�ȧ�%��(���������$���'�D��is<��˯j�d���]��w����B��T3�~#u3���?w�Wȁb����#��rg�����X�*�:�\��M<Ҫ��%vXZ�^E<���3R[u_��+�B�W��u_��z;����~5ij������3�)洑�4��e�]�	���f3����~gl�"�~AW��ƕ�AO��X�=7w����uL��	�A���Y��T����s�	�x����&V?�W��V�*V_~��2&���z�g�Xأb¦qC�ؽsh��9Jڪ0?������Lړ����T�/��qf+ET�p_���nq���"�������h�r�|���H��^?�i�@T�WK}]���*+ �j0��`&��[U,҇��V�S���YLQ���N6���8M��M)"3��ZR��m���J���6�cc�a���O��\g�[4���|�����|�ng�Eږ�2x:5M��5�?�x4&�]o���T"�}�cl��k]^��"��1q� �Z��0���!���9&��A�@:�`~�+U�ǹ�1q��p��b�1\�q�~��saU�·ra1��<�����t��m۲�C���ÎE�G~�g6�gv��5�і���h�0���m�K2r�#�	m"�6�AK�"�WY��]�l��,W���u1e4h�n,n߁�0_�9�酁�6��j�-�����c���M��9f��d�Ο�
�b��?t=_��(�'DJ��:ȏ�|�zږ�tv�P�%�hSy��W���]�ȣ�]ByԴ\�D�b����x�T�Ȯ��ug�X�#:pa��8�+sBu1�� -v�����$�T�[��N1hi*6t�ZL��L6�h�N[�'�X�S�����"g�6�(���i.ۢ���kE��@�׎:=�)OL��I��cF*Y�%��v��3Ţ7���h��2��A�9KQs���O����|4�O~��G�8z���h���Dڳ!L�f�9S�Z��S�a���M���B���s�4�qǗy�fǪ;�n��P=�2�ϒNc Y�u{XڲD~;J�|Y����vµg�)�;�߯t5R�4�    �K��E�Gec��]/������D_����Ŷ�%����~P<������5Kq��ݱ_�/nXU��n���,|��>����N�b�g��Y�Es���� ԭ��J8��D4�5�=��y�h���H�C�Kۤ�]���Ӆ����m���ƺ,�>��>x$m�bw�J]�=ؖ;�d��E*JP-�(����1��� ��w'�@�<��?䰒 ����+�Ҵ=�N�>�׿��5���W&*y���18�������rh0;My<��qgbu#f)Ջ
�q��b��+���M����'�
6���֭i����Ǎ�J1~��60"�Cne s��J�I���.�X�����9%�#�G1M��:2ڲ$nˢ.�*a��e%��P%O�'���9�~b��>,����I����)͊�Wi)�E<�J�� Ig��1�47C^��T�����Y�n������>�wh^|��o���t�U��y�w'Y�X�w��yyW�{o��i�;Ʊ.,��z7���b�7�(��P�,٠����	��MP
O�p6����%dC��%KRB���<���T�:!&��UĚ�RH�nGFۄ��{ZJ���07��:J?0y�=PW��PI=;[a&fg�\5E�2�����u��S�I'/'�G7+��/o
O\_��W���Ɇ��!��^6�]5�����ͺ|g�X��O�,9}��n�k!w�����L˛u��k��K4�."Z��Em�Ҧ8d�Y���t������ɗLh���R#�X�������T�3�����c��hz�DэЦqam�����v��k�W��5��s"O/\�9�q�>!�4t�3�#�1�AFǷf~)�,��A=o�ɞ 1Ą#���Rsi}I�>�֯��׻�dQ#^iڸ��2��,���/����gJ����@Mx�-��AJƛG�FVX}e���uX�z��XH���R�����!s�"Y|a<	A,o��&�k�q=�vX�Fq��Ǥ�m�ǩ��a�wb����<���*��h?GՖ��E��h�9âL�EX��Eǁ4��S-����?K,T��/���Տn�9��Pb����&�b�l}��邏��BϝqH����&rws�b��E9�>���)/���ZZS{�+�Ĥ�}�&�5�k0?���� I+��Z����d*�el��Ѫ>��V	'�0*S�e�W��Ν�|������f�;��~3��7�m5�뼑X�۹�	}����m!n��\L��B*��x�����fW
��ɓ�sgan��M�x�"� c�~%]>Vc!�!���~<��.��$���tn4��oU�Hx����(r�
��v|�3C�{�ޯ�m�����{*�����v5^Ph�\8�2�jw���c�����$9X26�2>#�p�b�p�g�$&`�T�=o��2�Gီ[s�5�������S������K�~V��n�f.�f^ζ��؏�rR�?�O��I#բ�|�t���9������G�b�ȴ��݌�W���K�t�$tmA��sK,kgOǸ��8�N`T���r��`o/�pRk��[hԅS���&0��C��$t��P�pJw��~8��<�6G��G'Ζ_��Ӽ�Wx�WT�<��#���F'��Jt����b�HE�x�q����E0^-W*��iㅜˉIh�t��p*��_{^SfV_�)���w��Jh�t���)y�z�]p�1�`L�Gj�$t�$�vz�+�������	+��R�tf�LW<��e�R�6`�I��uJC1A��Ex��z�L�A{�S�.'i�Й�NTӴ;QN'��d�3H�����Χx���Հ��֨�Y��\��U���$넹��OV/a�,�M��.EAB��/�y�	s\$%E~d.4��ԉ��Wv����7-�m����xh3��Q�U��؎�Ъ^��nׯ�[�&4�:a._%&�%(�3u*���(�x��\ޕ��p��d�5vBs���@B`Zc�a�O*�f�=N7�l>�����qd��Q41:aN��).j���y^��-.����E�84E:a�%Ś=�n�F�Q�س�n߬p|� ���	s��(!�F=�`u�x?f3E����� i��\�<J�1��M|�=�N������3��_���ւ�R.��zQmn���ū�����Z������Jo	��5��0��� ���<j�ͺ��V�����rv���'8��,�1i�@��Zͩ3	 BuMV�բ�W�Tvp�+�H,n�+�q��#�:f)���*�e!��$(Ť�\��Jpy�5�W����K'��ⵎ��R�gT�"����;U����ٯ��US�^xW.&X`$� ���G��Y> �fy�S�k��y����P�Zj$5X���*���j��e��v��zW�ڝgSb���9�ڶ�Bk�����uX���&%��ꐦ��PuA�_�Xo{��ۂ 	�K<딘(ܔ�Jy=�Ow�%R�V`Has.Kp:�� J��R,=��@����#ǝDJDR����=X�(.�h�rE�:����a�?�hԩDt�-#֦ϐPՇ޳�ܮ	1"�Q�R��B��x���	��z�i)�î�NF�x�;������0�#�9d�X�Pئ���H���}E�\מ��}��CF�{�z.H1yNS?6锏�`�����
??]�R��������M8�c��7GanɌ�B�/�2,�Zf|t���|s>��ȃb'Ō�u%��12^,WxY]��/��D)�FU���I)�`T��t*L��s4�H�/[5IP|׵�D:�����o7d�؛2��_��2��E'2RLV��q}r��E��W;z�IyaX��wx������[����c�s��zwr�#E�E��9��`i&y!g��9T����"
�s)&iHY�뭮O��Zt���]g��&�5/�H,,�ku+J,�ݫ5Ill�!�`Ow(������dzib��~.�4��n���L,��1:����F��d>`b��~��\qY(�W�s���/#��s�rld�k3�y˯F�L�{���=T�<��7���m=�L�âԱ��m�<V�9[���,l�kqtz�5H|͖_�g����$4�6�ی:5���-�£�>-�B��4ZVj�������-+��f�A�J-��O�?����HE��2{=RQj#�^eY�W���,|�ϧڤ4���􂔦�^������A1	R�g;��Д��&�=�\5XܕX��W�w�Btz�ޔb��0������嶣b/wb�R�\|�Ǚ��o-��>��PL܁ a����g�����MT~��.DVK)�� ��A8�aRD7��^՛���F��K1sV��l�(2/�ϣ�A�]�x%�x���#��b�CX|��1%E��ώ(Ix���y�(���� W� Z��\<$Ŏ2q`�C].�;V������ax��J1}�39g����e*S����v$�H_Q>Ӄ��a��H9GJ���=�"%pH�Z�ݪ-�<\���@if���`�u�#"����"# �u�E�Q���&�+�d>fJq��ݎ��RD���j���r�S�orc0~(gm�YY��T>@ �A;V��E�E��)".6���M�{lA!mY�����-���w�{0�7�.��@�{��{(1|:�4�A�p0Pzv���GJ����F���\8$�+ľv��g���A��q
%�n���!~����#�;���u<;���`:�%W?�5�GT!�k��3a��UE��[S?�Q�S���p��L)��)v7�,����UA- },%�f}�&&^�����pW�kڲ�����'�w��t}���\/ ��k��=��1
1���T�0Q�d|�_xb��4v~�sZ���$���"�8U�ϊ �l�m"*���;��w�S��&`\����bY���������z';�������V���5L/�����C%��=Rd�c}�o��&PB�t6]�����;f�np�������u!��=�4Ԣ1~�/��9�H����^O$%�m��'�j<,d���T/�����x�Y���FǕ㋒�G憧��)��-v�#m=�T�ԪQ�����    �4��7�+A�ٌ g
RFvVWʪɜ_�O~B�מ�C�E��~�-��V)"{�<USE�(�^uN�O�MJ�̌oq���.M�,���m�)4*�p�l=敺���`;H�Wq�h����u)ʒ�h,�{�"�)p5Y5��
�<b��Σ�_�w�~F.Ds���2�2f��6d�R-.�ؔ��4������4�p��Ѥ���{wvm��oK]�>s�����M`��D1Ʋ9�E����2}b�e�\~>q�L�V�w���Pw-#�K2��V�%Ӆ"ȫ+C��mg��H[)u�2����V�\�v���ڥnM�����*�MP�U x��T�q�֠ͧ��[��x��Y���k�qg:�H�r0H�w�z'k����gu9���U1�7PѦ�Q�.%D.Rv��uсJG�}����=�-���QK@^m�J��g1"n�D�Z���~��z��>pNݭ��u;u�,lS�j�b�Q$�����Q�l��Mז��O�S�+#�C'H'Kٺ��#ā`w����6ȣG�C_���&������w�Pѕ/����e�=�G�6E��I[%�{)vHW<��:�D%�􍬰i��nH���[o����ƒ�����e��}0c��ϋN$8FcP=�Y0��DF1��߉e�8g�mT�jSBҭ
��s���W���W"�v�r|���^��X���!�q������u�ŏ7:e����R��0�b��"�+�lө��|��m�wI�����щpXU��I�_Ϫx��r���֋r7ݨ����'�k٥ąKY)�7��/x�D*E|�Dk�9#�D��Ŷ0���K�	���t�H)�7B�C �c�i2/fx(28p��)��ԇ0��2�3A7_�gB@ǪZעen��yGW9��v�s�y���ۑ�\�km\c�n���Si������K'�D��'dEE[�ܝE~�V4aڵ=<�����J��c%��bS~���f�]�x��=��)��Nz����eS�v��u�e4���@�-J�W�Q�G���a[rx.�)ww��EK[��]�Y�4�]9?�=Cm�@�aO�@.���CX]��"˲0#(6�PDvDe�PH	]*�I�wGc��9_o`"v�M�@�q�+~Q�K�H��meES� �p�9,:U;.T�ߎov'�@D���Tk��s���}�ϝ�h��/�*b���wĵ��,�{lM����~F�H�T^��%�%J.��G>=����fW-�AS{A�	�z���q화�����Gq@lg��.���`>k�^V(��^T�e7m(�>���MxD�*�8���`��8*�,J��w�m�5;��!Z>��h�)����뤸�<LC/��bm��m=�`��T?SS{�3N��\�x�<��T��eF�RP_�
��S#<��K[`I���h�RD�"�o�l��e�7{f�3�9��rUn��A�h�P���9N��Ĕ���)���*E�Y�L#rD�
�T
*�:k�����)mA2�Z�h��K��B[L����9SJlg� 2�f�/u��PDj�y�1�RW�Y<�1�������.'����+�IU�_�Nsu�fk����'i�`RE�T�@BP�W(�f�5��ܵ�8�԰�U$�o֩&�Jʼ<(��m=٣������x%�Ry�$�:���2`8���(2?�3��";Q�%��C0}�t(�Q��`Il�݊3��p�w�J	Ĳ��axT��>W?Zr�FIKF1��e^��T�9��M��A}D>ٴ\zd'P�eqܛ%%�.�MքbQm�Eo�(<��c#x`p�a����I9�'�L�\U
��J�S�xGښb�#��hRB���t	�LU���z�RW�3�ضv��Z�R��QHF��S�UdRB&��ۍ5���`PZ�O��.�Ph��nLJ.FN��H�(G��6OM�O�%��l� ^�io�2����Y��j�����'�}&�����^1)�����jq4�m;]C�ݗ1�i����0)q����zB�-�r#4wS5�*���҆�;��E1�[�[�!���Í!7�)|��_F���I�B���{,$(7&W����!e4�?�.�J`��%�Y�V�{'�g�n5G����$Ǝ�(ܩ��>`���jW��F�m�Y���'4�?�N��Su��tV/��<6+�Oܣ���9����i@B΋��O{M	Y�����A0���n�\,	`����|z옰5K��>����ԯW�]m�z��'�<��� ����&���ScD2MP�*58SE�FjA�@��D��3y���7�"ES�t��dV�X�T���fb���1	�P7}^�4�g�A���/ (-BR\3�ߟF^)h���ur[�[mܽPD]R��qW��=ްN�::o�OF�Sw��'l�M��u!y�'Wz�&���i�������`\#�^��SrB6�����ا�c?)�6�<��������:U�k٩n�+>ڞ�I�(���ա��Z'��[�3�I��~%��>۪�U��\��*(�)�i�o�c�̗G�8��������H�#�H��8h激78*��l��
9ϯ'�h�};�U���:x�&�u8Ȯh�Q��4;�1���;�k�W-{��L�4�.dWR3�ES������ʱ��9�����r�,�M}_��5\aM�}Y�A_�z��)��҄|�,��H\�������,�$����M�A������wS��J4,����ݴ-���)w��T��,j'|�m=[E*�N�6z�֠,=x3���F�|C�W��I���x�4��m�!����t�t����:K�b ��O�����M���d�Le�[�n8�ů0'��W�ܩ��-��b�"f��N�q�hFS�S��(&�<�Йz���Hi�{���#I��jK���'ԥf4�=�c���ۉy\}�b���i����
�7Ԟa�i�{�s��;��$��yO]7�b$���� Һ��L�QWK��3U)��Vcg4�=u�SH��o"�m+�a�Nj��̬~�ץ���:8)a�����(#�)�0P��=q�/�<��t��a�^8�mhh�o����r���^=�ܑ���4u�W#?+%�/�S^�Į���)ʌ�����H�м�4u���5@�D�4u��ҐHf��v��\4�t#u3����:́OS?+�vҞ�0�Ӕ�(��V�4�=u3�Q�W��mP4	>�ce��
�w�_t��_��1��އ�44��ۯܻ,�X�x���<�x@���?��
j����ԉ���ϕ��jO������m5�+Y�}mO�O?b1���θ�۩�n�`Emӗ���@����~qa�n��w�&�]F��'�X���H�B���f���[����+=��k�A�eF��S���X7�j�:=`�i�i�vX2���7]�A�`F����/ԕ����ߘj������_�4Se��{@�u�@Q���<M3O�Z0�X��'M�?d�ApwY@�`u��V�v��/��,w�fJ��&(&��rR볜ܗӻ�e4�<��*�3i�v0��*8n^�Yb'�c3�S�f~v+Sw>��Al�����"�u���bb���0���
��'kfؾL^��j�p�=ȝ��<�Mg�A^�n�R��rVwR�4)<��:?�sSQ�o��t��
m��f�`1����:!խ�m7Og��qt`u%ifx��i>9��^�aeK�m��m��J���g#���AN׵HM5�:��pQ`4<�k��b��(�	᩻��t����})�cMfk	���4w�+�����sVJ�*4�e��hh*w��){l��W7����h��"&K�{8��!�!i�c;Ҭ�ԯ����Z��ӯ ��f�q񨔠�$rg�>-�$>�PB�Sw� ��_:����7��>��"���i�
f�����\�$��fE�v�[�to��Q@�ucv�=3Ms�ڸ3�����0�� �h��`z��4�{���s�����s��}���9M�B���&p�Y~N��,?��ܟ�,?�	�Wm��[��~mrR�&G��/��?-��b���w�Qd U  r9 }�����35-��*{JI�D�|e۞���Jh�Ӝo��D+UM������-Pg���:b;6��v���,�̯��)��,:'|�i:rz��e������4MӚ�}��ȗ���ݹEԾq�ZugS �׼��$�qyZ����(g�&1(�R]�e��.��??Ryf~-aP��pX�KϙURuf���D�ˣ"���ٖ%����SgVa��7�7*c#4Ķ��ؠ��͛�\�,t�������ۉq��ը��.<?���6[ͧ�`���I���^	$;�$��R̜�g~�\PLV��� ���U����� �J�E��,�]r��ќ�!g~|P�{U�qt>�6����:_��剿9MG��z͠���3)�꯲�>6��Ep�wAјpn����j�.��h��dC�JU�骕����Ve_�ղ���C��5�Sm�C��gKX���z��l�i�¼�Q��{�dit:��b��&1g��d:Smi���A����9mc���a�bS?V�����6.�y:�"��ˏq�n��ei�7��p���<�^f���|������<Ȇ����<�&���B����iJr��|G�S�x�ՠ���s9�̮��ʰ 9��ڸ��쩓[���e@9E<fa\ػ^I�I�T?��ƕ'�����r~�Z�o���ve!���z��ۿП<�	����Au�T��ˍ�M�_ ţˇu4�9�ˈ�b���|���9�tθ_L����s�j�\�1�wN3�3��� �Ѥ���[m 	[����)I���3�ڍ�r��f�U�+E���r{�%�Ts��h��������1�AC޿���FϿ�2ڳ����Q���Q�o����G/Y���Y�z�矿�R���S<���H����%�����5y�G/���e�r3������o@{������o�����������������o�����Gg7<�|#��B�O�3�����������_�����-�_^r��"� /~�Fϯo���<I�����4u�T��k��GQ�_���G������5|���%�_�8���d!�'`ɷ8��}��;[��ǟ�z�]�C��$���%�8ܿ�
(F,�_x�F���:���J��e���G��x�Y1�4}{)^���%��=�ץ�8�X���.��:XC,��{{}��`q��Q��i�1L���='<��h?����Q��d�e�h��x����g�~]�=��k-�o�o���~������������{���`�^q�FY:�g�~�����hT�w�7��8��=��V��s��9,�$���ǫԗ��-��Xf�B�����O�A�.�����/�Ba�8쟼���E����0����k�_
뇪���/�{e�	����VF��d������<�����[l=�����Ư�?`�/����i��3Pq8
_`���җ��q�G����8�=O�A�$�:�b��輧Y��x�/�ŷ$�{_�;_���9~�G�``��c���_G��,K���0������� �����T��$��E<�`m����/K�oa���,�����5f`��(�a!q0]�/`%
�^��a>?;��1���h�=L|F0�`�_��9͞ߢ�3���Q�3������:�`����S^����[:��cV0���g�W��#�s��d|����,i��K��Zh~ه���~���3����aa���{����
@�m^�X����ve��}_�a;��UI��0�k�7�Ko/�YX�_���>��E|�v>���^��o��,~Y�	`����,N�,s~X��fo����}��9z㣗W����*�߲�}������~����{��_��W�<��(��_�Q��%{	��=�<L�vSn�1pU��صxک�>�����xK��?_d��"���g�yߗ�Ơ���|aМ�h `f��K��+��y������=��/�s��H^���oQ����84�I���� ��ҷ����ʞ9_�����b�l���(�r�V����(y/(�"��p���|V�9��X���O�����_~�m?z�������8�o���Oaw%9�o��Y$�x/��9x ��%��`'����s���ӕb�FM �}�u4J�Q?�����*������x���ߒ���?�q�_���8�Z=rg��u"���LV�;��9:��.0��g 0=������@�y߳��7��\�,�.0��{ ��I$�� 
��45k� �����o���0���u$Ά��&��7{��6����2���{�Z�?C�g��'e�l��=/��
bڕr|I_�"|~�}��vU��9�!& s�(9��$���Y��V9Z3p���2�����o������@K�$С�������0�Еߢ��`d}������ 	�{�����n���Ǿ�{!앺L��g 3�	�}+F%r!��Ӿg 0��F޳�$.��M�3�g���^ߏ~�������e�����H̲_N@Z`-N�%i�3PU���u�+��m?�G�u1Dx��,��/V<�<���=8��b���!�H�����<�g��>UU��x�w?�?DQ8f�c��ƶ���}�c��W
@ʾ��g 3'`b���.�w�V�@���N�-�/v�%��5m���M�$I�i?:w8y(,&3��x [�W~��F9�;wE.2�<��@I߳�r�с�zFC]�b�Y5L��0F=�	��@�Y��0�=��9�(rY���L�g�����[׍��TvJx�GR��	��K���֢��_єs��(t���1� {�D}�@G��4���0�^�����+����e��0���5�x��o��F,���ox�**̻_����>�?1���p�ʹ��x����7�\tP;��n��g 4?�����{�;���"(��J��2���M
@Û�?�܎;.�zi��<���|�=#û�׳G�����;�{�Sat[���U싌1b�tE..��=p�A�۟0��&�X�RJ���ϚCtxX��짿����O�^Yf�      W   ?  x��W�n1}��"?`��m��V�}�e6ޤK�mXg����i�8���)�ⓣ�Ι��,�,��5ݒ-��ŬaE��.7n�Ŭq�)	ZZ� jM��^?�[��צo�;r����cK�g �ͻ5�3޵l��[�~`?G�vk.�����,qH">�t�����$nB:��h�����n����8!��$`BYm��ûd�p�D����4LX����(��[�;�P�����J늗[��$TBQ��/���{�L�${@[�`l��C��wB v*��5���l(�|�!�� ��!�6>]>���{�H�� ߯�������B��2�A�bv��0j����"���H��%�&g�O9D則(�`V"}��>�^��T�V�è�@c3V��c:���Ʋ��p(�;����ý�Y����k�E��-.+�z�`*�T'��zd�mf�ZVM2�w�4������/*�*er5���K�B	I��sS��~���!x�x�M�E��M�n�vLk��������#n�<�8�a�L4����c�]�&�p�h�3����
*�����Fm�´�E0�Pzi�]�xe��	����P�
d��2�o�}�1��&9�;��*��\1���uؼ�y����|�$V��3�ʍ�[��n������mPY�,�m����Lp޺����A��ҏ�/�6:�QH-x�� d���l	�N�e���I��9.��s2�����3[M�@����+�@�J�F!5�8<��j�0�G>���SH}覇�x�C��_}���2�6<_�-�ݳ�a��J�o�nX�            x��][Wܸ�~v�
��rbI��V4$$�d�2뼨�.J)����0u~��-�˒�m�>��5����}{�Y�i��'�*�������<Z�]�Y�>q��N���N�FM�Q�j��
(!�&��X?��X��Z8|��j^r�>}JWu)u��q�5�����_���"�Z�f�l�?�?O]����@����?��\�~;w��u]����;�Kɟx����}�ym��u�Kث��K�$��������'*8E@�Y�>�7u�ĵ�Ny��0�-Y�Y�,FB낗un_�նX��]��z��mq��!�"E��E�T؟Ja��^ ��^��U}<��4�7� ��`����_�|*���_��O�*r��:�~���!�zQ7i�p�Fd�x�8{Gc�1ߚ�y�)�EU����j��豴�H+��j�?�ú3�A�p�HZ�R��/U��\طu�3XW����j0%��,r��7%O�ʰEy	sj�=:� _=x3Q��ݤe�y�n�����"���D'�9�"���L���ε����yZ�R��9Ϻ�g��� SN�2���:����^�x"�x�"?�xV�:�\a�R�
4Biurx��c'uY�k��Ҡ�mq<��AR�*6�
^�_WEn�Տiɷ0kT?��T�>�*����8���2L��#nh����ٳR,�R=E*���@������Oi>�R_�D�Ka>����]Ӂ�Eߺ�`��@f�ȫ�����D���O������i��zԋ��;8��[����z-��H�o��Ì� �g�%������,��\�/�:� C4F��]��j���k#�JFK��K�6 uˇ�(�)a'}��	xY�yi8RM�B����rH� �z#L��o�l_&X3�|W#�V�'�m��p?���ܥل]�Z�Z���^uZo����PX�/	��7#�^�߻��tLE�=ϳ���Ӵ�9��j�nS�v�Ymߦ����U�����U�K�*0�UP%�������$��5{(�k����6�GU��m0��+p �Za����4L�bn� P��lX����<żpCf}������s8������8�	��O�6\�ڊo6<-(����6��h��S?�.�`�6N�lc ګ"��,���CU��%o��ξ�^�o�&���+�a�#E0��Y��%2_���<[ �B^��&A?��G��S�2��Y�7~9^����wU=[��
w���Nv& 0�*�'*�q���ʖ�b=D�Y���f������V�3^���}��e�t����E�?�>�R.��i>�b�a�Z;ö^É��1_���V��\4Ϛ��4��t\���
�X@�+Q8���ֿ�D}���a๗���NSTt��˂�!�(5X�;�!Hn���@	L0(��_��ѫ�a�(z>�_�ܨ�&���z�nPmr��}��'��S6	 �%G3�����[w����w���/%X������k�Sr��S��\0> �;+6���
��a��+�d�����x�~a0�������oi�ו!>�ۺ�`��a��z5�o0�M_��øgK� e��q�Q�ڥ�ҏb�ҏu��[�><"���[B�:Է�w����Pc��t'���5����{ĢCW�/�C��{bp5�8�l�ͫ��[��O������b�|b��M�]�*�Y��v�qn�uw0ԭx��ǩ�R�FdZ9_�_`W�v�B�;����4�閏7 C�}rcך�|i����c:� 
�P-	��RGԘ���u�0;!T=%�~�Maߥ�<O���F�"�	�g-CP��c�"�ߌ� �g}�Q�S~'�ʵ 3s#W�h����{�}�܇>�Q-�]��>�XG�;����"+�0�E�w����c�-K��Ms���U��0�Z�C��?K+sȲ�:�
)Q`ݯ
pQ��I�_�Ό�5���nѣc�q)��`^c0�Q!h�]�%j�[��ԅT�,L�L������/BcY�`�jye���hDO��X=�2ؙ��o�7\5���4WX0�#V׼΄��5��?��Z�_�n�X�G�+9�D���o�������k��T�T����ի�j�=<�ƈ�*ӷf�D��֦��{̳�J�o88H&���S�2#\G#=C%+�5��9��{�M��YW"[�|m<�oqv�P[+��-Sc4x�L��-j��m�C+�4"|ǪPϺM�����n�j��`b�[�w
]_0�,��}���}�\ݰL�O� �3���K�o:��[�:T�"/��DP�~�)X��l�հa`t�|������}qh^��u��e��
�ł.f�_Ѡ,����3�}[6�@Q=v<�у'F-��LhC���r"p�#0�MW�r��둒"�'o�z��Ծ��VL�ɈYe�����YW����^j�탄� K�!�J�y։�!�`� IT��D�D<����Qs��\4MC�z%����6��qq���xU�������U��Bn �4a���Uh�dʂ���R�ud��� Ћ�댔�Ǎ�Xg"AS�L^)�W�nH���0�r�s���4V�4%�5�>j�=�����١��)�
��d�5L:]�K�d��ěg��oD�܍��.-דG������.��$�*���[�����p�^�ւ�����o���k�� *�B��Cĕ����ݒ��2�S_���
,�݊B���0ݻ�y��' f.�`o�r�m'���������Q�򜪆�f��\�%i�G#F�.�!��|�� 0a��5�:8@��v�R���&!�0S���K�'�ˤ����(q�Q�E%�`����Zt���L�J_�lh�$��o-:��ў*�Y��Օ�	b
6y��n�CO��3�p��4�`�������T��DK��5��	f*X��$?ΰ�;�6<p����>:�L�^���1�
2yd���k�C &�6�z�w��T��-J�U�w�;������f+n�.�R<N��%��Q��g��?R�E�1�`��<5�M��<�W:�5�ֿԋ�a��S�	��]�3&�G�9�C�=�@��r���4�p��(&樽����+X����ɥ�>�f��'�T(bi1�M��T��tB����huɓ��R��10�0:}�?d�2ۗ�M}.�W��Y���N��^C�ִF⫨*��H
���U��CQ�A�WQ��v�}.��M)�u�T��;��!��j��= ����"%i���xu�d�1봮`�h8�8t�:J��EZ�����#*m�Iz�o�M"��A��N�-�M�{�j_�"d�o�m���g&b(�<iƷ��]�4�F��pL��6�~d;��\��?�*:���.��Ć�o��)�y�~T`��{	�64k�j�7ɴ�h��*>�6��%R�z��;��|�@E+X��\�F�_����4M�s�@E,��S^�ka˛�^�GxJj+	TC)�4�_�4 dVL ��@5��k���ދ1�݆ـ��JA���
�ꮶo�g�5�N38��T["ИI�a)�z�0��0ri<�"�;��h�k���
H\�f}��J�����x�x��eX�7�9B��7�S��xF��D	��]�m���*$��A��aX+��y��yVL�D�%*#9��_��� G�Sş0�W���0z�����p(a�컞�vc���bU܉Z��Y&zr�Nި	V�ȳ�@QV�t�^�A�7���
FQ ����e]����\�����N"�"�W=<�]��rs�`�Z<b������EŰ	U4�Y�H�c���FI�ZBxU̍��
��'�T�T'�OTȡ�M��A�My>�w�8���� �^m�<"� �k�M���&��HA!�}��B��oj���%k-�s��Yu�af�}	�}>�!���lG)x仴�n�Ƒ��Ɣf0��/q��2�uY�ʾ�1�� ����c1_��{!>|�].    4
a�2�y)�ǟ|eL�1���s]J4v ���0��I��[1��.����^Ȉ���c�c4a6x ۹�IanЃ��s�I>	��%�ܘ�q)�����rp_9H�
M$�:i	�v�[���f�gkĎڸ���Oio%����h��V�	�/�BS�.o�*�[L�B�:J���
N����I���4�p�e|�g� z#f�h|�<�!Ue��� �a��v�.�w3VS�E����d�4�TL�TO�.1��?�/��F���jn�@MbC��5ER�ʱ�Z+S�
퐖q��)��٧�铁p�\;G9����������v��R9�f�AҰ��
��Ĭ�^2�8l�]�2�����.�6�m��s��%�f�6�ҙQ��t#�*#E"� NHT��%��a}���c2U<��<g�D����7����Mq�����ȵ&*1�H�l��/x�.F�� ͷ�#f�����vzV�<׺M�"�2�fS�K5� u��R ��d�.��XO�^�<�,뭰?���	�]hR��؀���c����)_�e���Hހ�-�iH1hjy�]?��Ȓ������uS�5�]�n�j{�`��Q^l������5�R��d���,��'�ރ����Ƭ$U���(��M�VT����s���2�;yvUL�=XZ.k�4e������U���"�Bs��N�u���R�Qfh��}�=��k���AU,
0�0Is�ȶ1��3/��y*a�����6�0;�˞F�^�x��lH	ñ�T�(𑖗Տ��Y�t@�TiXxS�-����-_�$�@ހ�}�%G����i_q�H�oX�\��1T���:�Eb_�gsaڴm��H׬K���6Qi$^�缫�M�
=!��{8���C|�51m)�"](Y>o��.��T����jX0�x��h����.'���kR쀡�K#wV�aڭs��@��y���ې�8��F�0�O���A�i'i�ɘ���D�����,C#��d��1�.]b�Q��9:O��=�l�ձ�4Lw��(ڳ�+�����0,��n8eP{ꩀ�0�,��ҢQ֗Vy�3��"U��(��a+qp"Ft��()��2��+�P
��`�^�=Ǡ���ƨ�Sa�@��i:���r�Q��D�φ��P�*���)ŗv|_��DXn���&\E�8P��ƣy�����.G%R�kJٔƬ]�q�@�<iˤ���;΄,���q�d���%K�D��nHY{&��4���h�/��w��%=����,?_EО?�U�t*���\oWp@�E3��<
��а��l]�`����o� ����e X�%ZKz|��I\X���d�
8.��z���4c7�J���3²7w;>k=���7��*�`��s�}+������һDi��kI����v���hYw�hloczxS�����<j�
B��.�L/��{L��.'$��$��y��v���|.s��{�9��fvw��(7rO���y%��Z�i�w�����18�* ��ACƶ���$K^�[>��h!�g`�m�F_�g�����զ���SSV#r�AQ1�Xt�*�/��WԊ"�ˏF��4���EV�t���eE���!��3*H���|h��������p34Cs�ַ���>�V�єX�F�;TA�QI��+hd���cx�mP
��b�Q[���YZ�[d�w`Ms���q�z�A첢�����L:��ie��/c��K�F�/g�X�ʩdLfjt9�(6���y6З�w�$h�2�h$Awy�#�X�
��!���P:F�0���Q�^�b���oM�N�<f��������Et.	ǜ�.�z/��x�b�X��u�2�*,y�u�)��J�0VRI7 �sNn&�0�I>4j���][�3�)UH�B	I�7�[���a�+�*3e�`�<�|������S���q$������h���ٓ���G�r,?��U��;\Nt�����+0<�h��57�����S��`�Ye�g���ƛ�Q�����Ol ��>M�W+��������{�y��2��p�v���4�*V��u[TΑ^j�p4,��eH����ț0lwb� � i*4���)9��	kyo������{�~��V�|�����������F	V�ʏ��ⷼ��ɼM��?S	�A�ONm��.76���N&sUD
����7���Ǽ�2���ZH4?C%-k�(�Sz�ȏ�g�O�c�f5J�?E�P�IO�T� ����� �%����^%�\ ����*0����+�3�#_fЫ�*D���o���6gU�63�ɼ	e�Ի:�����J9���E]a�|���.�q*G,�1��bQZ�6��{c]k!y��d߃u���X|4oj�y�̣��V2�pxAӗ#2��:m��i\Xj����}�LMy������Ζ1s,����� �Ӌ��_���Nэ�2}�LF�k><�9PV���̸��aL��*�i�G<��1{4ԋe�6�Y��X�������F��A����/��5,Ɉ��$�)�9�}	�P�O�a�r����g����<�n�j��K٣�c�f�����r�͏���Վ�J�2��3�C}�2��pm���e���,�����i=��wP�T�N8ב��	_�.��ї�JZ�_��`T������4��ڥ۞{��S��*��2�o���	�i��aT)�ȴU�D�{����q�|� �x-a���*�ے5`AU�vD�K�{c��m���ߐ��T�v ��9VY�:ݦ�S�^~��<�F�c*i; l<���f�R��#�+L�l!A��w��F6��U-<Ti�ɉ6�M��ƅ1B�Q��%�O��il�k�0�"���� �`����p��M_x�=��LenXpj��A���3�# ����Y��5J�'LVV�z1>lzU
1�|[a�I`�V��A2f�*i;��WX��8���<F�
K!��U[���}٧�c�hPLek����[nʈ|~�gܢ�T� �hV��R	�cƥ�R$y ��C�{�n��0PP��A�	�; ���=="h���VQ����2o�L�Ǘ�v��[%k�o}�2�7B_S�=��L�jQ`��+��rM=F�
BQh�*8��ћ�o�J����V��E����M�r�������t,�)�"D-�6ȷ���h�0[L�j1�zJ-��3���|5���P�)�i�8�b&���_�B��_5��س�Ҟ�����H���+7�)��Ps�������/Q��e��Y�hmx|�\t�Ⱥ.�;ɫ��Յ��Tĉ�: /��/�j>�û��`�1 �b��?׹1 ��l5�r�CW����Zٯ�}#��b:�H���`jn@���B)*3;t���N6[�̏��M���P�)t�a�aݹwU�*9;t��Joo�ڨ�����w�0R��P�"�*C;t��\5K=���d�Led�.��W2�r!�|����c�+���#��!�xX	Α������!��V��j?,�R�C�Z_Ӆ��#��G�5U��!!M�s8*�7b&&20��
n�#�.v0Uzv���XQJ�l���� ^eh�ă��b�����*Q0����oy%�0<�A1����j���r<}n�{��J�Ih�����X2썓����L�w��c*g;�b�abKS���O���w(	�TwH]́���8��q5h�(�n�Kgβ�{�k�SəL%t�������GS+�Wm�a?Ͳ�����8B��	�ab��nz���Q$����v���ݿT���y��3/�C}�q�9<]0�����瀄�-�>x����~�=��6����:nܼ
�M�S.���/(P��?�����SfSz�\��m��8`�%/w�i�;�x^'��@�d�� gN#��K/�u�+r0���0�n�{}��C�4�^�qm�x�	�޺6���Ӳ���cν�ý8u�0p�yB<'	�t'� X��ϏYمK��rpBa���M�h�1���w"/I��3��p�`������a��m��8�m���+����n�i�xn�12����`M�%u �  �4���������C"cw���ą���69����pBo/]�����:�<�p޽���9gI�u�'��}%p��M���^9�y��9u8�p��%l�(v���E��aQ�����`��I����Mv�ow��84eN�z>�F�|\���!#�����{ޣ�Mv<hw�2�A�0�	�����X&�?�yʖ���W���h�d��8�'ds7\�ԙ�4����3 ���C��k������%Uwy�&u����t#b�ߥyS�Ӿ��M= �k�-E�~��~���������v��o�q$�if9j���|ǉ��`�x�%Oa��t�ݘ'K2y���ǆO1Q�5=t;nw��0�4p�% ���Ǆ:��΃6���S�} ��7�m�o�%������{K�yQ @�Z��K0ؘO�I��ҹ����q)�	{;>a�Y�m�8aG	Kf�a�ad�3_F.�$w̃������M��>�hf$BO�i�d�6���;��F��t"1�O�e�Q�q��ℝa o�ϡO��FС#�n��4��A�ľ��)��$����,���M��1g�,1@�7�
8#/��(�ς	���AD��0,��u^<�����}a����VF���6�~�P?�|���������o���#A���:�����6毯m��&�$�x`!�������z�!:�����M�o��ɲ�����I0#z͎��V[{��)��	���������_c��xJ�e�Q��C7+�N���� e�}M���r��P�p��xYԓ��;dM��@�ڶ�0@a��8|��F��3X�<˶��;�Da�?rt�ʢ�v�Aj-+�\8w!���۵x( D�<r��ڶ#���>���N�y��CP��}�P��I��O��m�,׎�����K�K'!�gN��`4NFL��ka���a�
��m�����_֊u���Js#y$_"
�Ø�+�r�^�#�Y(9����L���U
G�������a=����l�a9���^���m�k8�f$�W�N��M~o��{�h�mڱB� ^dKu�V�������]��at����m�%'��N{L`��F�=0��C׶X�8��-�Q����8~���������F���#j��V��9D�����!>�I^���2�$���T��*,�Nn�	�������� ���{*��ڶ FG�͊�؂��k�z�I(Md�\� �1P >�}p��%�����q�]��¿L��_x�z��)(���q@�G&O�~Ib-Y�>+��+�~ë��|kd�?G1+�ep���=�������Wi�[8�5�-���} �Ȩ�7=N�@�&uplq9��~&Z��0�a�
=���Ӷa����5����krB#m��5��:�)�B�Y�m�����#:M��V��4�t�7uBl=��{��ݻ����lb�'>�ok��Y^�G�������.��&�L��G�I�M���
�E��j�#��	��u�mM��kp�W���ΚU��[�-���&{�zK�=���(&	�mR�kuiY����i�M�?{�����+կ�_�U�uo�ͨZ&�GM�"s��ZaI$J�ھ�{sK��F����-h�(s��5~4����,���5�^]��Ѧ�4�a
0����r��A��<-�ڎ��_���[;˧%��t\m���c�1xE&�0���sD�(^>J�ƍ|�����+��U�q[�~���C�|>�|��Ysp�C|7~>�qn�g[�X4p�"�]�hȺ��h�#&��6�	=�?q�� �����	3ů�^�<�a�6�yPHu�<4�1N@�d�yΗy�A�����t"��j�`�����/�F��      %   �  x��V�n�0<�_�`��Kor	�A���e1�j�6$+E��+���)Z@���43�],�u��f�x
���mHK�88E&��%��&��=y}�����6g�]�]��]L��H.¾Ǉ�1a�	p�0���~u3r
�=5O��}��MX�_W�}ρ�Fwq���J�v��W��@��t�&��0v� J�3P��2�Q0#�f��>Gb(b�],�Ճ��㢈Fg*[��C�Y�P8��5V �1^�#V20^8���GU��ݭ#/���pa��`5/m-�V`Tij�ʐ��[Ӂ?^J�0
n�ia�����E,�+ �T���� �ib�ޞQ��˷��
(�#a!�m��1���!S��/��^�9�J�.�'�-ɣ��)���a���g��b�M���6$o�����,�_
&ʡfd�è�#���>�_!�j��k�L�3�����א�(�ÑݲL�}�ˡJM�����n��K�è�9�B��ĵ1������i>T�vX09�J3]���#J�V9�o/�l��hH�"v�e
妟	uM���9�ځ!���$E���ҽ؂S���%o�P��'
:�� �]��R�������Y+�\����$�Q9��2ׇ�) ��4�^�zcs��M:,��/�t�� S$W;g�	�0y��6���/���~��e      '   \  x��V�jd7}���T$[�����,tJ)}�۲7�&�!!��뫔&;S.v�`�pΑtd:�?���q����G�H��H��Y�$d�p?���xwsW��rgk�� �١Q��c(&1�H<�t�t��>|>���=�?���X��q�Çzz��5`�O�O�������X ��e�aø�-�\C�
�
��	Q�d�%'��}���@��-�BC�������j�Dc�Bڨ���������>�u�Z�Ά�x�X�@��@Q9��)�������𹒩��R�����	�8�#��	�����Њ���Ŵ�-�B�Д
D	����	��d1��!���\�)�!����-r�	u⌣���}�iB)�U%)2ZPzq��ɯU�;��9�(���xM������Q�U:���l��3{�-�\G�4�
��{�@3�P[)b��r�����đ�Ѣ�Z���Y���ϵ5���*f_k2ڸ�����㮍u�H��%�$�闇2Ąk��tue��󆴑�aK9W3h����W�2��K2,�z�/jr.j�Y�*���m*z�b�&������J?<�f�-���ܜ��R��qN�<�x�E���"��.B�R!�P�*-�94B�13W|����n�F�=l!:g��FTO��GN����8�:���\��>΃9)�X��'Mb~+R�%ya���#+y8ʖ����&��pz:�&(����j��m��7��f��O��T�g�`��{(S��Eg�"3��������r�_��g8��q���A�-���[ݍ���ܽ���yzt�Έq��g��¢U���}I���'@�ئA5��j)Q�E/�̮</2���|�aY��|i�S      )     x��VˎG<�|�~�A�Mv���Kr�՗~�.�+��A�>����:��aC$�jV�88����|I��*8)�C �H�z��<;�>���;䳝�;Q � ? %$��Jh%�qz��D���՟��~����K���6ӕ\C�|����Y@�'Ъ�����Wr1&m�%v�A� �����ʔ�1�Ȅ�w���t�?���=l�W�H-J�j�W�!�!0b��]e��J�S@֐!��,kE� ���d�N�5��օ�Ӆq�n��ݨ�8|M\E�(�5v��4;j$���O�;�|��U�W���ݲv!�a3ያt0�@�9���Kb�^kL�T-�����|��K{8�O���z@Y(,>�a3�L3�*��G1��썎3*�92���_.�˹��"ӯ秼>�?�O��.��?~�{�-����+�\�!��ڃ�´��t�L��'e�@&Lt
� �$�G��_zs�O��M6+o4h+�~�x��� r����A���ƐFZm����d��J5vfU��L=�ji�c����GRԵ=뗾�3�ZV��V!��Av������BkSV"����?�㕀7�t��_|6�:qŒ�S�pB�&V��P�t4��i���s�Ϙl#��8�`���7K��fM����jQmM죕�D۵a߭������v�K�t�(s��I��b5w���Y>;�� �VQ����.1�?��u��{�Lr�~�J�B�'����%$;-��+zh����=Ѷ��T�q1K�`3��)�b\C�F3�J���c�洬�&��m����.�-���vut[��"a��V�%6��`jk�I�mh3NNG��M���eg�B�Y�0�m�fy��&���lm�#�6c�B_c�㕶���f�m�V*݌�B��g��|l'˨|�??�y{_��L� ��f�ku�(�/�a���B)��5.�Dկ�&{������͝���6�_��W��1������H<,V��t�|�ܞ̰"��'����˨��������/`m�      U   �  x��VYr�0��N�4�V��C�	�#o�
!)(25��Ll�L�B,=7zO�� ���ߵ��ѷ]Ӡҝ-�����͞b�Y#����m��խ5�S�vC�r�i�C�\�� �~�/��Q����M�ʘd|���I3��rc��0+j�W��N9�-���1VV9�ךnr߹&�+���I<�:�j�_�z���Z!��X h�@��a�}���]�N$����MXC�v��� R��
�=Y�4��o��� &�ZE���s�Co1����+�w<A��t���|��5�(S��PG���0˭���d(��a�^��u-q��
l@E��*x�!Dl��C+�b�#�3`�E(�9�M|�p�k�E��%mz�F7�]��j����c���b�\D�YJ�5Ʊ2~�]�17˒E��]�Xä�!��(��%���[�f�|��G\�H'����U�hF���{����f�,�aq=�.�p��؛O�9��r�U0G5��2�DTE�W��G������j^�Q8��2�|�<D+Щl��0Ʌ�)o�ٖ~�8I\����=>M8����0	f����"�{�a���[ji�7U}>�f%~�5L^;m�`�̲�aUpI�%��p�SZ��cz[���)ƒ �0	�����C1���z��&��=b�0%��)�<����w��ӱ�I�5������)�8/�ȿ��E�>U�j�&�~H)� �p-      S     x���Kn�0�x
_��"��� ]5�	�5iȶ�G��>��6n8�@�w����c��������^)���Xվm���3�J�A�U�����iC��"�A��k����<���#�+��5Vm{~�N\ᕑ�u3�n�/Հ���k�ge�]������2��z>îo^�����N�S�钪�۞Hc����v�P������N��^��yVc���]ؘ4a{TM���l�1A��u�IH��ɑ��3L�U}lN+.�JȯOC�oW�9='��ǪiW`�ƞC+�oO���{�Np���k��F�
+��8�.ܺ&q�c��aH� /.��f/���s^�y� eȓT[Cn@���iE�D_16��(*�L�e�HgJ���S�f�S�ԉ��s���KՄ���U�V�WJ�K,��a�Zg�X's������� �j.�84'Q&�8T/oy+I�Kr��y�sE��匀��<��:�T-h����6^{�&�� t��      #   �  x��X�nc9<�_������40}�����%�%�r7f�~�vY�I�d�f�#3�KdR�9������ ���{�{I��]��ISXɜ�h�s��؜��h�?^��e}15wY)6iL/2S񲰎ձv��bgzI�7Zi-U�ZmU�1�X�0�����oǷ�����{Yt4FeL6�%��N��|m%*.�����S�YY"������*�z�����w�v��0��e������NN�٪%�P�P�2�d䞹�D5�O��.m9��L��4�4|52�t�J*wi�V�A��f���t�o�+�����U��&I媒�a>Xg�N��ՙ�'�˝ƄXC2�à۩K�t2�C������s����� G
��dw�씙a�.[Oo?���M�\jQ%D?�-��H�q��u#eΙ�����L�Ɍl�	^�������S��"�v^�&ܔ�ʦ��^�3�J^�H�m��r����V#�d0����>ʔPX�kj�I��&VO-��t�^�l�s;J�w)[���t�d����X����t�7�S��Zﺮehya����*�����g;,i��N���a"��U���f@��hB{��EZK��6{%W�2v��b���is@A����׻~Ճ!+�q�X�I�\�#� 6Q������w���Tb:G~|�sD�d�Lqp�ߧ��S����cj:a��%�Zl�>�p�Yi��9ɺS�sz�-��<,����cB���b%��3�����ê�
3L]r3:yoQ�Ό�F`�4���I���܈(g�<�'��U�z��lv>74�/�1�0�n��qP�� �G�A�,��|��6_�9��{�Y���J{pk('���Y���n�6��1A|���
w�^��׀[@9�TRR���:�!R��7�2$�6P��t����F71� s��e��6�.)��TG/F�Ls�E�{4kn�Vߴv���Z��e��e�:��h��U���3L�J��!=oӇ44�S��%䵃#�(z�h�8Z#w���>�$��P�C�L�h�l��56�̏�b�/�a�ܔ�v���ZAk#�k�jN�ѳ��-{g�O���P	m.'��(�dAG�*u����ɔ��q�a���,�X�3��P昐�.��5Պ*��H�yIz���$��X�ں7��6�.5�U.�e��v��?�/B��J�d�)(lp�hždJ��Ob�%�	YЁOA2������ⶣ#���&������=2Li%t:4:}A���r'm���Y��X���B�SkG-AvP����0�1=`�IP�y:���:�[��)A]��aZ��ڎ.{&��V 仠�>fI�@k���~��=��y��S ��z��RP�Q�9�q�Џ4�aB���V�	�s�	t�����C�b4\0���H��\��\���\�Ԃ	mnM�6���z��f=Ä��� m�׏M�e�	=���b\��2��z���P9��Wx|\,����);Ä^���1� �x!ő������~K��޳s�v�	�&��as���%�j�3L�*E�{��U�L���@�f�X���\�!P��-��$��0�zj��on����sk�����|����?$E��ލu�2c/j����P�i���^��;��-r��Ǒng�|1�C��C���M�{:�C�\#�3L��g(�k;ylF_��	�����1�@���}��~�x�.��0-k����D������F+L���/5���ru��l��N�3L5?*}�|h YU�
�f0�����+�g�X��r�uk��W���1aV7����Ϙomn��F0� �dg�0�jڿ5z��o����������,š��u��,�0�V�3�O��"?f��Bc�j�2�\`¸���H���!l��}cCg�2�_`b�;=�S����{����Q~�	��������)��\=<��E<ÄY����I>��}��[��cf�������a⏿	!���|H      �      x�͝Is�ȶ���𢷤P3��(k%k�m)��y2ej��T�"�<e��f��1�;�@eP'v!+�y�<������]����?*��mڗ�Mw��z˽嵷��������}�>o�Չ2�������/�o�K��]�_�i�ʊ��>g��.����Onᝠu1nM&�Å������h�jʿ?����?��w��z�3�z��鴯'�������Q��Um��V6WV,��o����/�ܟ_>��<�����
��磇�^������Y�wۓ�k��m�a���z���˰s��>|�mٟ�g��-LG�V����R!S�M����u��O���'��y���Nc5�,ϲL`�tC^?*�t�C�i0%3�:�Agu�e�
Q�1(`�Ff(u��3�,Z`�:�� C���Nc�� ]�Q�18`(
���i�ɠ2��Nc����a��rd����Nch��͔��ͨ�LV��Ts����/�Nc�0���u�A�z�:��C.]Q�14|�Ȍ��rQ�1|x���^K�L��EGBIWD�i�Z�D��"la��T�i�R�|�3�if�N9�Nc�\Jg�x��h�T��7���R�;D����.K���:�fr���C�i�.�~u���l2#��g��GNu�Ù���E�i
�Ld(uC�#��Y��:���F��F��`q�L̪����^�ی:��z�!�4���Cbgys��M�?�t�g˒�Pi�
qBS�p�T�Ż�˻�h�PiT�Y^���w���4��* P��������b�{����z2:���@5Ņ�H;}��J�X��4SKq��:�o.C�l��d�����cz˛0��ĩ�*�	d��4R�q�:���͝t=D��`�"1�'��z\*ȥ�u��ɼ4��:�'N.1qr<��>��į����z�� ��-��[h�cl��F�0痂WU:��V}b9������I<�2�Q��lY�˨�2$�pG���\��E�is�$��:��eEb���ye��U%��G�vÍ�Tb�T<��N,�j^���V�~uC�'C��4��:���|J�Q�1��0��6�4�s|�!�4�Iq�;�4��<����,�u���t��<��9�,�s�D��07�\��i�Jr���� 0T:��"C��x�p� �^�Nc� �J�1�� �D��jw����S��٨���gx0&x&�2t*i�t�F�D�ș��kD��:bnz'=��:�5����,����x0s�ƉیyDBs,Uy"��W9�tq�%�<��M�3jm4�Ɗ���Y��Ϊ���f�rQ���p���ril�:� ����y!��t�Ci��:��A�����j�ۦ=!��<�6L��ϔT	Zk��p�H��J�U�H�*�jm<�9G-�br�ƃ�03Ӊ��f��gZ�#�Ejm<��G�I�Z����-�7rq�Zykm<����km�d�S}�<��=�.�<��"���h$��/�R?�t��#!CLu�L��j�� �yRh�7��"�`�΃����j�*��B�[�b�2!�j��� r�H\́�!;�e��SZ|�t�B�yu�y!dǴ� e�1����΃@ǔ
*�����C3{Ǉcƥ
7�=�z]Sz�P�<tM�0��y�REc�� ��TR�<tMi��y��C�J�A�kJ��J�A�k�Ĝ�Q]S�ʨt�3M¬Ѭ�1��(��-1!�\�?�Lͭ>�[x �6���]SJ�V:]S��V:]S*ît��T�]�<tMi/�J�A�kJ���΃@ל�i�t�3�E�J�A�<S�-��y�R��ian�)?ٵ�Ȉj�w���ғ�J�A�cJ�LU:S�7�:S,��:S�W:b��|.BSo��\S�	�t��X�u�f�98��n�wu�Ɛ�i���Q�A�4S���:MSJ-T:M3Q#e�5R9�f�<�2˓r4�"1�.������b�\,�q��X,��)�,ӳzT~Y��[k��`�8�T�X�4�"C��8�z�,�S?��S�m<�GDK1��
��oLu�E�~�1K+
���T�A��s�u$��z�1�nz#ݘE��N�X@v���3�v�k��4ҙ�M�΃�p�ō��=��.���c!�2�΃0�[yUb���~�PyX���O�y!�nu�G�Σ΃!yG�ys���9��yu#t4���v�i
]T\Վ:B!�t:�΃@�F��*�jG���)�jG���)�+���)��V�<tL��	��!>A\��
S�+��iS\�:S\ۏ:�&��%vQ��)D������{�F��΃@ǜۅb�� �1�*��� �1]��:fE���N�0�⎔Q�A�cJ[�U:Sz�U�� �1�z��� �1�z��� �1}b ��̠c�Q�A�c�Q�A�c��΃@�D�a�1��J+��(D�nJ�؄��j�-:���W�y��_Q�A�c�3g^��b�E�y�ҾE�΃@��=�΃�9f�Es�(j�1��+���1Ų��� p�)��D���)Fѣ΃@���:S, �:S, �:�H8fAtL��)V!E���Ś��� 
��{�'��h�!�|:<q�!�B�]�km��!wQO�UF{��P�o��!��~�w!`��ϐ���^�)��y!��X��=:��oF�y�b�S�iS�7#�<t�Dٓg�=t�DM�g��t�DM�g��t�DM�g��t�DM�g��t�D%�gV�tLq��� �1�,�Y��1�$�YI��c&*I<��$G�LT�xf%I����$��J�3QI♕$9:f���3+IrtL��	⫔u��)�Q�<tL����ě�3Q�㙅=9:f���3{
t�Da�g�蘉��,�)�1�=�Y�S�c��c:�c蘉�"Ϭ.*�1�=T�΃@�L�8yf�S���(q���Sz�o�� �1uV�Xge0�uV�Xge2tLqK��� �1]�1�1��|���+�f~���N�y���΃@�L��yb��̏O��yb���1�w�X{g0���w�X{gf�����k�-<�q��-<��sfFOߺ�I=��ƃ1��cjm<+�H��Z�5a����7@4�x0a��s�5]�6L�`�wt��x0� #�Mm�ƃ)f�З��2k��4_D��e���ƃQRזO��6����K�fm<с�k�wf΁��B����`�xz�
�Z�K��c�C�9�t�Iu��ƃ�s��H�M��SH]���y�n���Bi��ƃQ�5#����x0�� ���L��l�O$r<1�c0���}G�΃���X�g�=f�|"䉱 ��$/��>�<|z��yb,�`6ɇ�s�@���l�Od�<1�d,>oMĂ<1d0��C�1�11���$O�&�&yq3ܨ� �1��V:3O8fNtL�&yqKި� �1y5O̫�&�D^��j�I>�W�ļ��l�O��<1�f0��y5O̫�&�D^��j�I^|�|�y蘉��'��f�|"*�Q1��$���ybT��e�Q1O����lR"*�Q13�MJD�<1*f�IE�'
�O�e�ķG������zb��`6)�[vG��Bv�@��&�D|0��I!���眘M
��^`.b6)�o��:�I!���4��lRHd1�h0��@�0�&�D�13��I!�a���lR_�u:��*��� �1i�@Ls�&�pLEtL�&�}�Q�A`6)$r���k5�M
�\k �Zf�B"���V�٤ �S �<tL�}�Q�A�c���t:f"f�K��M
s/���<��]��I|���lRH�1pm����i�pq��X0�-����DCl���XP�x���so�h�u�FU?Rӓb�HE�6���P�x�����p?��a2>��?�Z���h�+����������팿^�v:���ư�����v�}y�G[����͕������Fw]љ֭�(���,_�Œ��V�� �  ��dpsy�o���o�����o�9߲0�R��i_6����-����F�����'��f����^~V'������;&��u.����ЛR����0�"8Ӳ��[�з�3��(S}3,ou+��rj��A+��?��V�L����������b<�1*S�V��^Y����g~��G+��o��]u���3?��==��m�o��˛�峕?�������%�-��A+��?������%�5N��A���iy0ʍ���=�ܴ��ֶU(�c�U��y����ş�a0��G/WO׋��^�y����75���˭"ֶV������o����7��v�?�.e��f$���.�\�0��-k�Q�̰5(����"��aQ�⏟�/��q!�2;(���,k���(�����V��Y��~̗����ï��l��~�`��~���r�����x����[Q<���p�|����;�_?���Tk?M�%�/�B�ʟ~����k~�A;���z<�u��>?��}6�vGÛ����`g����O�~���m�ݫ����ݗ�_�����Zr���%5=9yE5?H�6p��=�G��˝��ځ�[��2Y��۹����ї��c�3�:��'?w־.�?�L;��b��K6����������c���|p���=�/��Ǜ���K��{f�o���W�v��m��r������m���r%h;���un��}�͓o�$ڏ��˦Y?]�߽�������/��v���ӹ[9�z0~];/��������p�}�����rKF-��'h%���S%��0G��V�˗�;��p�����57��O�������$�۟<�v֗����������yؘ��TT+{�K��T���V�Q\�D�a���j����N�����c����;�����z������ۋN��{v�w����wZ��Ty�%��5��
���� �i������z�ǯ����p�M��|qo��~��=�ݻ�X|�Y�x5'���������/�*���,i+i�������� ��B            x������ � �         6   x�3����54700�*�S04�1!1~@�eVaQ��`hQa�P���� +ds            x������ � �            x��]Ɏ�<w}E��p��q�0l7�_�-���T9�Z��-Uf*I����,` �g\�/��^�ˣėݾ�v�],�U;��ږ���ߞ��z�<n����O�e���~�m؏v��B@�bn۲y�"���猋/���������g[/7-{\3�"�U����fO�n�mwHK��V�֧:Z�4n�ĉ'qi�8ݫ
�E�>�8�N ��huEt���֋h�O�U�eY�+j�M�:���Iϓ���A�hy��0E"�pcp��m��!y�9���m�RHn.v۰� y�C<w�玕	���Qf!C^/�m�Ͽ��6O��pw0zDH�����k�<x�Kq��<��08�NpD^�M(����	��G�D�����	�ȋ��w��6y9$/�+�L�|9�w�#򢼢���MƘ�#��N6�� bZ�0 "q��Bh�X˒D�B�Y��a�7�O]���i�(�h��=|D#�l���L2�3Pߙ �e�\��������v�T��������$�Ep����✺���#�שčK.��L�m�Om�b�zT�f���t��ݢ{�X���Í��/qۮ[3q��k�.�����7�Z������(O��'M���k^�ԫ��=I�Ԇ��Ȯ%g�Q�.�6�GF����L&�Z����^1����B��INJ.4�
7�Z�pS�8 �%���ٴ�XUn��,�`x���Ս� ��65q�肑���N\�r��&ó�E��k=.i2<�[���d�4	M�<���{C�{z=K��o��ҡ
�Pi ʳ�KK�π�� �[���hJ�#}@��hh�H�7�����5�.�Fz3�nh
h�>��K7.���8v���H�ĝ�H�}�<��7Z��	���՚}�mH �����r���=���K�
�� <xD n� ��N�@h�=��b �g3(�7�I �\��h�� �X(���I �J1)�� �5:���1a��x�Aa�eL�}��W\ÃGz7�I���^�vf�X���
��n�[H�8����i��Ѽ@-8ˌ��L������]d�!͟�	�x� Zi�LL����ǜ��~t�7#$�qHFl�)#��9�7틵S�(2p��CH�5��(���mƐ9��==�SR�E�Y*����	rb־p���&ؠ.b�pOM�Ae�\>r<�Ŋp�DN����d!� ;1�_���	:�b�\�&m�N�p2�#ӿ,��	��H�����t�Cc���(��ɿ�!�>ЊX(�o�&i8���2��eO�9�X`� ��^p�W��|�>š�[=a���3�F���҂�#�u��ݱ����D7�p���!�Fzi$�]�~Zn�h19��F4��X�-��X��~p���]H��	~w��EyX������DO��3t�@(�
k��:U 6y<��9W��#�X{��E��]��	�@l[B�XӘ�J�
��N�hq7�2��Sk"�QM��%�&��s�"�	�z@B��_�#�;��^ �dC9�ӗ�L,���%'~�δ��ǡ� �?;��O�� H�����0qkP�k¤�4:� ��ΟF�I 	�X�:�G�I 	�X�:��mL�����u�#?��L,��P	���ݾ�PVĊԑ=��L��"6(����7� �O�U�-y�����Pm�GZň��E8E7���&��%�#z���I�p�κ8&B�ZL(x6�o�"zg��y�ܗ�b�~���K2������K(q����(1Y�K����)ʫ��p�U竮*W��RG���æ)�l�nv��|`��\$���'~��Vا�PmRG��Si�*K�^A(f�E?N�IG��`&;e��8H�!v�R��
+��e��+q���_��-N�i$��DަQ4j��Ar=����;� U8�/�RZG/QYg �����Zﬃń=�#��'�����灵�۬�LkV�^�����#,w�1���=FݱV2�V/�����pQ�e���%��OC<a͸�<vU�����^��~��ay��L�I��<�8�fz�z.�_~�{�B�",w�I+���=�8B��t �����ay��\��ݓF�����c�.��k�֥U߅�s�aa���n���3�V���H��v��f����ai��8��z�B �C�����]#H��-[J�����x��G��)���{F!U"2)�� �"GP#��z¯R������_�;��T�,��$Z�����>�T� ���#c1�gG�p�"��tC�7�[�ND�	E���z�1�x����ʬ/A�~F��ט�#8�t�����y�O�U��S����H�e���ZS9ذ,�/,j��:ذ,�$,j��I�����Hb#V�1��Uf��1�cT��(H��>.҆[Ù~��,A�ۛ��C�P��n�u۴=[�����n˒<Q�!��r�jJ�.��>�V��b�f��&as�5yM�7FX?�F����u�]�:RZ�C
H+�'n�E#���n�z����F�Q �'>�����a�P���Fi�����N�{o�&Y��br#�~���Z4�	黰���@�q��Eze+6T��,�Liƭ��P>ˍ��/�8��PF����=VW�g�x �Q6焢�*�qA�����y�1ɸ�m���Z�M�\n�)wD����{�)��'����5� U����r:+DIs:|]�X#{��;+_u#֛&E�}�P���H�p�������ݷu��E��Pod���/R3\�
�����e�x��wS�ɞ����ҏ�7�{��|G����t�a����A�"�Lr���FA�p0ɉ���PHn&� m�:�p�ŝ��&~����dIB��EM�����h|����m3)Ó��N����B��Do��$v����DO����B��R��|�V6&���3���u���Q	Nq�_�8w�aYqy�;�Ge!)����d��TB��_߉�mc����'~�����҆���а4j��I7]��amTxӜ/|K	Aa'`X5��MOjKLMx�U��MfÇ��a�D��P��;����<H��8��܎��n�� �HK��!A�����@��HH-���ت��(��r����7YBa��X�m_M��6Ba��x.�ט��q{�X&@
i>`�kߧHH��r�,٪{��7�&׃]�6AB�vp��T>��7�O��0�3X���>�.�G0
��V<�B!e�0��D8�����G�DC>�7�A-E0�?!�[	)#8��O���hD�x��'T�N��2�X�9�d�	)#[���6p����P$��e�3j�8��O���]�Ұ�A�w��u�ð�J�>�)	5�����	j�H'P���"!e�^�x�(�8I�w�Iur,��P)��Sw�\4�.��[�6���P5n�nZ�X��h�R-�H�~)�m�9а��Y��s���X����'8H=���}*I�g���<�=� Ix��V��5�I��\	jʧÖև+���������>��������rq�.BͶ�o���)7��=F�@��	U��	��~[6��^�����B�@�� _<�ٿ 8D������u!��x#��� �Q�V}�>��τ�/u��^s	�@��J7|�`[�@���8|��`AHwT9��X+��8�>Aʣ�:�o*#��P�
��*�I�K=�?�ѱ7<BU{( ���0$w���e�p6#�/�(H��������g����w�׶'���_*XXnc5�*�{ԉ:�a��n� âpz+7�r���K�e�r�D;デ��.3�'����Ay����!�u��N����&cI�T�ೂժm���E�S�ϴfYS�"�%m.Y�$����j��ɬqo�ۗ���W?���zP�羟�IB%}�uCL�*�^�%�D��I͒�R�ʞ�I?�)�bV�\m�dR�mӰ*-�aMfƪ�}��mY��W��[(F �L�=�*y��g}3��8��*d�_جlZ��C2=cR���2�X��,�gES�^eūT�lV'��;�byUUL� �   Z�4/���s058�y�$���NR��>^1����֪�Y=c��5�5	&��̒:�Y�TSe:Sl��?e�ʾ�Y��r��$�j��i�G��$2���Nn30O�5�L�,ci��@f�h$+��)�&W"�gJ�u���D%�U��J��_lgu)�D��G���{���FQ���1�C"�C�������?����u���            x��]M��6r=���9J��I}\��ᰭ����^�v�����խ�ѯw�>I �L@���j%�#߫�2�l�/�u���R2�h�	�����?�*[��������i3l=�ߺ����^��c����]��)�n�C�����o�����M�W9��G��f����
�d�?T����,�$��"D��,I4I�T��KR学K���Z�	�L�&G���C�`r�z��u���X�y�Q�Q[�)ӱch<�Z�&ԲC�Lώ��͆Zv�a�rL]�9ԲC�����Ԅ�vH��5�u]���?��?�0���C�r !��ة.�:U�_����u�ֵ`�i*��A��u�JL�5�q���u���4�D���Vj*qN��m.���M��8�����Rg�JAM�g!��@�v7t�(�V�+.��L�]�u�PO_p�
���gh]�*��y$��	Y�/�G&����\����OT\�o?�����_.з8�Ng�ǟ)]�L��T�������&�	l���EQ0������~���~�>��0�1��������%(B�?�qtEn��m�a/l�@M?d�1�&D�ه4�"��(B�~��ݎ��R���͝�[�	5�i�Wt0q��$�t�X�5����!�p��Dk�L�����{��%IԆVL�*I�	I���2�>VUS��5Mfȇ���������=�4�rS��D	_����Z<h-��c9�7S��P�x����K
hJԿW-d2�!����{�h$�k�T�R��e��g�X�ՕD�Ӛ��^����2����Xf!�)�m&3��uz����Ǥ�C�?�,�jv3��Mf7jq��n�(U�ݨ]HUv!Uf�*S͆�:=em��h*獪̢����q�P��̔G#D������rS:qN]/G������c�����r�w[ז�]FL�b7�-��h�B��_	l� �"�L�J`+&��O�.I`�ơF�aĔɾ	lM��r�i����g�2w�n���>�7�=3��u\1�ꗋ�6�CV�R-���Ϲ�S, -~���S, 7���3s��X ZN/���w�{�&H,���؊!g���+�_K���%:�84�ZQ`�e��	;n,��Y"k����Ƃ�%���kh�v�q��.�jhNwc�t��GzCs�u��Ⱥ���5Of�!k��̖�'�����*3��A):�&8������ʭ�)�fG�fWe�M�5��QF��*w�����`��Z�Wߤ|P�A����Nc�)�l5-S�L��A��C��?��AH�4=�V(�	Qٸ��?�=���,�^d��7L��G��זV\�T�vt��E+���c�D>��Ҫ�+:'Y"oZ����=Q��z��s�%��Q[Zap��X�Y"�b���f�X�vZZ�p�XN^"+�`K�n,�8���ʄ����l���h���<\�(Uh�h6Y"kE� *lƲDV�*4mAn>Q�|�^��v���{�
-<{!DV�*�rlιDV�*���3��7�]��0Y��(�̕<Q��E5��anȚ�������=醬�30����Y-���g*��zA��9��a�EYN� �Eї�TeE���E_�;QQ�U/�jQ���ey���p|�b�BY̼ k�З�N,����tB��L((��du��O9QQ/�JQߛx��g_��Uˡ�Q�g���Uˡ{�>�J�5�Zݭ��2���j9t��g�P��Uˡ;�>�r�5�Z��޻�i�����<?���Wa��}�m	�p���{����6Y�,V�pͿ3�<ac���sf�Y�Y��5��s���~�Kk\��l����ƕ+�}f��ۯ��G��9���ss`��y�3�/4��=.. v�).b��ӯ��?���ixy����H��պ�>Y3?��:�ʕ������(e�a� X���9�>�9�:��7H4��qs������v�7f뷟L�V��Q>)��.�+���H6왗L��w(�s��kԢ�'M*O��{؉�<���{��~4�g6WL6�hc
\@4QED�9C[�	M �f.�_��o$a�jԡi �B�Z�Mh
��K�2M�kT���Fti��،+|�6|����{?|��1~ANU�,�|�ݕ�8d˳Z�W�t�\�_B��"�̚B[��`�a ���+�������޷$Kt.�0���a�ԋ)p�4��l����O������������������Ȭ4]>��R5h�}�8o�$���95���F��|� ��?{ax�WK<��y�]�+o4f��� ������|<�a�������#����H��3�..���X2����r��[������.N�%^�z	d���X�5��v�K��zz��R��|�o����~��>�oL[��gd��;�x���1_6`5���a�ܚ=����f?�^ܗ;�\#�K���퉣\�R�uҐ�i�L�}�S����z�,�(r��*��w��H��O�:�h-R���(��euF�B4c,���6�@�F�	1�d��9u*��b�d[&8-��Iu�m�uFm��oS�S[o��R4ލN.9�N�
)�O�>%͐���:A���'�e����3Ea��i���.k��z�h��m���v����Ds��bh�,4=����`&��!�pʊ�����1���@M�z���KUn/O[�ThnK���xF],4���j5]Х�JR���i�
��BE���������[�pU33|�%�����n�!�����iA�{I�gkXi��޼�|f�z+�=��\^?3�_ê�|�$w;�U�$��V�82c9��앿�AmxŒ1� W�5�K&k�:5���X2s� W��D�b!:]�;nj�l7w*�թ)2��}� W��Ȁs���NM��6��:5EN����:5D/�!�y���a��+&i.M����3�j�,RS$�����52 ɿ�&.љΟr��V���-�K
4E\`�mtD3>]��U��~^��e]�x�y��ܼ7�-�&���5�q�Y���	��Ǚj3�ۼ��4b]x-n7�'/9�2p����o��Kw���Hּd�,y���;/��ǐ��k����?�3�C���R!��8ܗ�n���v����`*���Z(��{��L����\�"���&�����
�Uc��WD��_ ,O����"��5���p{�h9w�����2�^ǀ!�:!����ŀ#Wk�Ț
�����l+D��������!�\Ս/�*#DVp|#h�B��FݑO,�qn���/���"ȡ��<��r�c��F�D�d}�Dm�Yܟ�����//��2�6��Όo�8(��Y3��|Y��h!k&]�f�P�A}�.(Aݝ�2���N�[-��.�Y�.�(��
��rMB�Xg`��BGn��jF��F����=�kXim��|\^�ݝa�2P�=}�0�ϋ��x�2v�o���2�p�}�v�0�����E�Ҟ�[�!�&C�-1}�����Z���� �˳J�;�M��p�բK��HQӞqK�Y+ߣy��q� ��S�3K�1����������<�����˗3� ���0Ҟ�N�Y�����c&�g�j-y�}�xz�:W�৖�-y�=IY�����-y�=I��L�{X}j;sf�$������3ef&��Z\|����l�՛kX�4O}/�Aޤ09+T�4�/����S�<����IeE�Iw�b���8=s���,�M� W�M
?��K�������v/��;�)p�*��c�LY�רj���2����㧔f;t���s`���0a��P)��M���y�\��������&��ʢO�O��M�-�.�����g�˶&7�����+�?�>@���{<�8?���/ɬ��h�A;LLk�L�}��1�{Oj�u�~��RG?�t4q��og��ڧOo����s�/�$�z��Gh���O���*����{#�vJ�~F6����}o�b�@?o�K�XDxy4�W��;��W.�1���ҿE	��#*�q��M��h2-}��x�� �j�:jD��yzw��q �  @�G�@�����\7�v��C�07#빞:�o�/�?fvO����X��h��W���\_�"��FHz�I��!�MKݘ\gb*>�{�2�xǌ����������T 5��S�:�3��0�U3͞�Y�7pj;�vjz?ft&�ѽ6��ȗH������ƛ���Om(u�N7�aJz!�2�o�F����"�&`)uq4-U�R���yˆQ���F���� �N��W����W�k�����Z��p��Eam['�~`b�Z���D�Q25	.޺�əI�MA��Ѥ�&JQ���z���*Lmc-�v���粟���U��u��Z��BPU�{e	p���D��jl�}ߩa(��Qd��d�Qh�1�&� ��V'�Ӻ��%,�$�V���4�M�倫����?��sQe�(�N\8g�b�k!�B�[�C�;>4�Lل�T��Xk�, ���W�5��y%�& �}U�9?8����o���KG5�Ug�T8��:�5�ҋAu����sX�8X�X�/�|2M[�TZj"������ST����ڳj}�;��%�?(>;z>��z��^�����i��<$U�_C�g��A��,�{;�>��TŴP�4�4J��{KÌ���SG�Q��C7�ε2ws�$��\�8�Vj�֗���8݃S9��k};W+����4�%���ҕ�yHEY�I�i)`̏���8�0�!H��bH%��pD]�&��QN����
HL|jh�k>���zR0�|n�]ILq��7�hI�F��j���~�?�y��|u�|�'�Z�����J�M�2�/���*���:��|^��ݸO`k�)'��8�o#�0���4PSO��BA5�#����ԙ��	�z~w_Z²�G�c�F����C�װ^���ԝ�����;�\���bm��ǣI�&�*0x0��03�sQ�� [i�~�n�}�$=[I��l�$:�j��(�I	�!�+�+�>�\����U*G�r��j�YB��Ѵبԝ�ᮠ��Yl��n~m�7|��m�}r��Y�:~��QW=T�	Ae���7���d�4�� �wn��/��y�yh��F�R�b9sǱ<M�����jTSc�>8�C,��)(�{1�]nc�u@Y
:�Ik#�P�;�N��M��,e�l�	t�q��w�9����2��|���+��ej�ؠ�_���+6J��ۦk��A���8�l旸���/3��ʽ��B��hRo����z	�ʠK�y��C�E�0z��z%WZ]�B�s, �L۪��z:��)���Q/�;��a��5���+x?�v䣜�*H�)d����_���G��|P��ȥ�����5��0�T~�23A'�
*�YV�e*��9�G�~:��Y�����$��Z���e;�]�ܠT׏VA�%�p�]��.!� ��ZB]~pp4q������������r         �  x���Ko����ԯ��z�q?���AI.8F6�pH�h�ь�]��_rdU�x��0`؆X�5٬S�l��I�u��fש�k�o�������O���~��NB!�N��z����Y`�g��?�Ńml'pva���E<؄�f���*�&p�n�S����կ�H�J:c/�����d���dr���'��'��g��|r&g����09'd ?�\��!�};�T�굔o�Q�j����/���4с��E�����;ǰ����=T2�0����Y�T2�P��8�Uy�ȸ!�f���ߙ\��%!��*�NJ;/�枍�_U�ǀJ�����h��4��t��5����s�Si��JR��$-[ק6��>$14������lD���e��z<%�(��)�B�V������㧈^H�(�S鵷��U��t�SNki��ǰ��'��&bh(h�=�7/]_�wO��T)�m���^;�]�\��%��d�F�dR#ЫOj�O&5����ñޫ���l���
��bK4�f�v��g�Pf��Ē:�b�v���)+�G�XRS����t�۶���j!;H@2LT�CF5¼̨���)P �
����-�cT�:J��TA�J���q��N%�H��5����e
�ƨ6t���+P�����@_�GF �Ֆ��d��ʄ"���0Y���йf�\c�����me��
�,GjV��и::���r�téd��b���T��ͨXme�q��m��D�63�VF}Q��Y��6��X���X���সos�)i��b:��@w3���36���o�&���9���-���T�(�g[!}�%٘=��BB��$'s��[���� ��-�~�&�ρBgla����l����ڱD;��v��1�/���4�{J��vPY�|'�.�i�Ʋ���7�pt�!��xR}��H](��n,��X�HO7�����@��}�-�b�EO�w��N`��
�JgT����Rm)i�b���[B�0�R�L\�AeH)w)�&.ɦ2�����S�dVR�ȭ��k�V$�ʐ�&n(�,�)C����4"&nHaW�C8�� e��l%l$x\��Pƪ�VҼĹdV*��V�V�U�z��z��ުh�I�b��
�m�ls}���%�]#KwĪ��n\'m 1��;@UHo���|�W�|�Bz����ȥ�E���]�o�޷��F�]ʳ�ki���6��.���m��W�7�:$�	`]RpHq8�M���h�-�t����9��4���5��E'>�q0�hՉOy<��PD�N|��`f͈����9��BGOډ��)G+O|��`�f�T�͜���K�9"���� ��^��L%�L*����
�t��G�/g�L�YT88��И�e�����h��G$C�,.��-�����9T<0Ze_�T�Ȟ��2�fc�����z�����)-�/`*g�M��hE|S9#k�FK���9S�f�}G3O��P$J���!
E�ǭ�絋�Y�D��#YZ�(� z�(�%T���i�"Y*AU���q�~�ۣJ����ql�� c	o\^:�v�6�r���?�E��U1�9���⾿��z�6��؝���"�)��̤�]U��<��d)�5���n�dla��n�t<a+d!aP�Q(�]H{*�z�P��� ��jg�|��geOa��Fօ���κ@6�[�2�ї���>��"�5z���v:`�_d#[}d�Q~�A#�K��$��ۏ7���j�{UY�V�e��;)21�9�K����s��:��ڽ���$�=#��L��n��c� 1�q�S��n�7=>����f��������F�+ dW!���?��O��90��n��g� $��hZ#�|���d>�t:A~���m����(���-O���t|S�ɲZ|M�"�Kj�.c�<놡�s[�"��ج̺�Q\����ANmn(�n(ԫ���3:]�"�����T�ϝ�:ԫ�{Og�Uꟻ0��ϝ�k��2û\��_�};m��~��'�B�^ �V�����Vw�)fjw5�<�Ű<B���anͫ\�i���sk���s �s [�#7��*�X`$�|�Vw۷�a�Q��:�d�q~�@�c��v����|\�2T�~e�ɠ:��_�oQS���;(�:(f �ݚ�l?)J��4���2��Z��a6�zYhG������V����?�*-S�?4����;���m�����?����7U�%�H�O�/C��OD��P��q�Η�Me�d���?��f�cLW�P���RW�2|�+�G��ū�v0��me 7�Ox9o�B�1E��@�����\�����Srlb�+*��� j�������L��b�;�-v�Jr-w����f$2-w'LB���	����Dg�+PA������}��~�N����$F34��v�*�����@u[YyD��5 r�����:���c�\�f$l�Y*����D~#i+&��u��v����6S�T�q<P��޶����ң9Ο����W����T��@B���;�H!A(���E
��I�0�ۈ"�5E�2Q���G�lK��T�'��jF#TƠ�@_*���GG�"6�Q(P���*�"G��nTX�&b�@��M-��D�}��b���B�MC
�[�9�4���%PQ�m�=��2.W�}]"OA�o_	y��-]~niS��<|PecK��D~q�'��̴~�f/r��[9�(rQ�$0�Q�~/H�����m�^I�&?�}U��xì�<�F^���vЁ���� '!��H��E����|��|��7A���G/�K���y�|�BFS4�j�*:6�~[���}u�ޯ��zOC�٧t�/�^�+�����D"�!�����F��K6H�,�Q(�-R�ψa���T�nH�F�Fa��d� `�>�Ҙ�Y#�q�TC9��Q�4���ꂃ�'�����&=.錇�EX��LK'ry`��0�a�*���t+i�!��[I�y����P�<'��=0�X�9�W��P�*�I�����`"_�I�џ�X�-��h�H���E��J1�bZ'�����L��Z%���cQ�8ci�@>!�\��a� ��e�h#����"�6 ��&g$]� ��峑�v�o?w���y|������/�Zk;�,�}��"������Ž�8�^붾�S����KCA-�X�q{�R��=��1ʸw���R�E-�
0r:��_:fW��B��3���1��q�?����B�cZ��)бP��R��I��˫D�~�&�a9�B]f��]��F��P� �5]# oS�ka�uM��}
u-,,B]ӵrF�_=VkiF$�ٌ�<Q��Fm^��$�t�A�97���&�rBU%�Ǿ*
�
��Ai�B^�k�B�VI�#��4*��z�\����{U���E����1䊚��c�g���&�γB�ii���\�m^����E�����Ma�v@V��{V�����d��>dՃ.���Yd�"��~��Һ?��E��R�^W�q]�׺��Sx���������n�O���:ia���i��b����q�I�L�T�UVڪ?�ʿ_j����Z?���P�vg�w�~n]�]�J���6.U�MW��l�7몭��>�9�ʇ~�.���¯$�?H*��f�?P4k�fe��31���H�>��}�o��sJ��J���	F7��z����Py�Yf�r�UU�\�jKg���_���$����=���8�ow������E�k     