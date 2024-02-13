<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();//
            //foreigen key
            $table->string('name')->nullable();// 1
            $table->string('nik_number')->nullable();// 1
            $table->string('kk_number')->nullable();// 1
            $table->string('citizenship')->nullable();// 1
            $table->string('gender')->nullable();// 1

            $table->string('place_of_birth')->nullable();// 1
            $table->date('date_of_birth')->nullable();// 1
            $table->string('religion_uuid')->nullable();

            $table->string('blood_group')->nullable();// 1
            $table->string('status')->nullable();// 1

            $table->string('npwp_number')->nullable();// 1
            $table->string('financial_number')->nullable();// 1
            $table->string('financial_name')->nullable();// 1
            $table->string('bpjs_ketenagakerjaan')->nullable();// 1 
            $table->string('bpjs_kesehatan')->nullable();// 1

            $table->string('phone_number')->nullable(); // 1
            $table->string('photo_path')->nullable(); // 1
            
            $table->string('submission_status')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_proposal')->nullable();
            $table->date('date_decline')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};

/*
[
    insert into user_details(uuid,name,nik_number,kk_number,citizenship,gender,place_of_birth,date_of_birth,blood_group,status,financial_number,bpjs_ketenagakerjaan,bpjs_kesehatan,is_last) values
    ('people-MBLE-080005','FERY IRAWAN','nik_number','kk_number','WNI','Laki-laki','Jambu','1986-05-02','O','Kawin','12345678','89751223','12300','1'),
    ('people-MBLE-100014','ASEP PURWA','nik_number','kk_number','WNI','Laki-laki','Bandung ','1967-09-21','null','Kawin','12345679','89751224','12300','1'),
    ('people-MBLE-110017','HARUN MUSTOFA','nik_number','kk_number','WNI','Laki-laki','Kebumen','1967-04-15','AB','Kawin','12345680','89751225','12300','1'),
    ('people-MBLE-110021','HEWO FRI UTAMA','nik_number','kk_number','WNI','Laki-laki','Puruk Cahu','1970-05-17','null','Belum Kawin','12345681','89751226','12300','1'),
    ('people-MBLE-120042','SUJARWO','nik_number','kk_number','WNI','Laki-laki','Demak','1967-06-06','null','Kawin','12345682','89751227','12300','1'),
    ('people-MBLE-120056','ELVIS WITO','nik_number','kk_number','WNI','Laki-laki','Penda Pilang','1970-11-28','O','Kawin','12345683','89751228','12300','1'),
    ('people-MBLE-190335','AJINOMOTOSON','nik_number','kk_number','WNI','Laki-laki','Jingah','1977-06-05','null','Kawin','12345684','89751229','12300','1'),
    ('people-MBLE-170175','ARDIANSYAH','nik_number','kk_number','WNI','Laki-laki','Jangkang','1978-02-07','B','Kawin','12345685','89751230','12300','1'),
    ('people-MBLE-180256','ISNAENI RUDY','nik_number','kk_number','WNI','Laki-laki','Banjar Baru','1972-10-16','null','Kawin','12345686','89751231','12300','1'),
    ('people-MBLE-080006','JAMINAN PRADESA','nik_number','kk_number','WNI','Laki-laki','Paring Lahung','1972-05-10','null','Kawin','12345687','89751232','12300','1'),
    ('people-MBLE-110027','HALIS','nik_number','kk_number','WNI','Perempuan','Lemo II','1971-10-03','null','Janda','12345688','89751233','12300','1'),
    ('people-MBLE-110031','MULIKATUN','nik_number','kk_number','WNI','Perempuan','Jember','1967-08-06','null','Kawin','12345689','89751234','12300','1'),
    ('people-MBLE-120044','PIRMANSYAH','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1991-11-13','null','Belum Kawin','12345690','89751235','12300','1'),
    ('people-MBLE-120063','SURYADI','nik_number','kk_number','WNI','Laki-laki','Kandangan','1979-09-03','null','Duda','12345691','89751236','12300','1'),
    ('people-MBLE-130072','MAWARDI','nik_number','kk_number','WNI','Laki-laki','Manggala','1971-08-01','AB','Kawin','12345692','89751237','12300','1'),
    ('people-MBLE-130080','BIRA','nik_number','kk_number','WNI','Laki-laki','Butong','1977-07-14','A','Kawin','12345693','89751238','12300','1'),
    ('people-MBLE-130081','MATIAS JHON SUPERATTO','nik_number','kk_number','WNI','Laki-laki','Muara Lahei','1974-01-01','B','Kawin','12345694','89751239','12300','1'),
    ('people-MBLE-130099','SUPARDI','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1972-11-04','B','Kawin','12345695','89751240','12300','1'),
    ('people-MBLE-130107','ZAINAL ARIFIN','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1975-07-01','B','Kawin','12345696','89751241','12300','1'),
    ('people-MBLE-130110','JONI G.','nik_number','kk_number','WNI','Laki-laki','Kamawen','1971-03-03','null','Kawin','12345697','89751242','12300','1'),
    ('people-MBLE-130111','KARIADI','nik_number','kk_number','WNI','Laki-laki','Kalamus','1984-04-23','A','Kawin','12345698','89751243','12300','1'),
    ('people-MBLE-140125','RIAN RADESA','nik_number','kk_number','WNI','Laki-laki','Pepas','1994-12-08','null','Belum Kawin','12345699','89751244','12300','1'),
    ('people-MBLE-140142','ALPIANSYAH','nik_number','kk_number','WNI','Laki-laki','Buntok','1969-12-12','null','Kawin','12345700','89751245','12300','1'),
    ('people-MBLE-170249','PEGY SULISTIYO','nik_number','kk_number','WNI','Laki-laki','Bukit Sawit','1998-03-30','B','Belum Kawin','12345701','89751246','12300','1'),
    ('people-MBLE-180261','LISNAWATI','nik_number','kk_number','WNI','Perempuan','Lemo II','1988-08-11','null','Janda','12345702','89751247','12300','1'),
    ('people-MBLE-180265','GUVINDA','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1996-11-21','AB','Kawin','12345703','89751248','12300','1'),
    ('people-MBLE-180282','RIDWAN','nik_number','kk_number','WNI','Laki-laki','Butung','1998-02-26','O','Belum Kawin','12345704','89751249','12300','1'),
    ('people-MBLE-190346','KIKI','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1992-10-19','O','Belum Kawin','12345705','89751250','12300','1'),
    ('people-MBLE-190328','IMAMUL AKBAR','nik_number','kk_number','WNI','Laki-laki','Pendang','1990-09-27','O','Belum Kawin','12345706','89751251','12300','1'),
    ('people-MB/FO-160181','SUMIATI','nik_number','kk_number','WNI','Perempuan','Tumpung Laung','1978-06-24','AB','Janda','12345707','89751252','12300','1'),
    ('people-MBLE-190315','BAYU ARISANDI PRATAMA','nik_number','kk_number','WNI','Laki-laki','Medan/ Bar-sel','1992-03-25','AB','Kawin','12345708','89751253','12300','1'),
    ('people-MBLE-130092','URIANTO','nik_number','kk_number','WNI','Laki-laki','Muara Bumban','1978-06-02','B','Kawin','12345709','89751254','12300','1'),
    ('people-MBLE-170233','IDUL LIADI','nik_number','kk_number','WNI','Laki-laki','Hajak','1995-04-23','null','Belum Kawin','12345710','89751255','12300','1'),
    ('people-MBLE-170205','ELDUS BERNADUS MBETE','nik_number','kk_number','WNI','Laki-laki','Palu Rejo','1995-07-08','null','Belum Kawin','12345711','89751256','12300','1'),
    ('people-MBLE-120050','BUDI SETIAWAN','nik_number','kk_number','WNI','Laki-laki','Kali Pakis','2000-08-28','null','Belum Kawin','12345712','89751257','12300','1'),
    ('people-201911002','AGOGO','nik_number','kk_number','WNI','Laki-laki','Jambu','1968-05-09','AB','Kawin','12345713','89751258','12300','1'),
    ('people-MBLE-100016','A. KHOLIK','nik_number','kk_number','WNI','Laki-laki','Tulung Agung','1962-02-26','O','Kawin','12345714','89751259','12300','1'),
    ('people-MBLE-110024','ANANG MARUF','nik_number','kk_number','WNI','Laki-laki','Ampah','1969-01-01','B','Kawin','12345715','89751260','12300','1'),
    ('people-MBLE-130066','KOMARI','nik_number','kk_number','WNI','Laki-laki','Pati','1970-04-23','null','Kawin','12345716','89751261','12300','1'),
    ('people-MBLE-130073','FANCA FRANATA ADIATMA','nik_number','kk_number','WNI','Laki-laki','Kalahien','1993-12-13','null','Kawin','12345717','89751262','12300','1'),
    ('people-MBLE-130100','MUHAMMAD SAIDI','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','1969-11-08','A','Kawin','12345718','89751263','12300','1'),
    ('people-MBLE-130112','KASIRAN KAMA AMAR','nik_number','kk_number','WNI','Laki-laki','Montallat','1994-08-05','null','Kawin','12345719','89751264','12300','1'),
    ('people-MBLE-140123','ROBY RIZKI RINALDI','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1987-12-02','null','Kawin','12345720','89751265','12300','1'),
    ('people-MBLE-140138','DEDY SUBHAN','nik_number','kk_number','WNI','Laki-laki','Sampit','1971-12-18','O','Kawin','12345721','89751266','12300','1'),
    ('people-MBLE-160163','SAIPUL BAHRI','nik_number','kk_number','WNI','Laki-laki','Asam-asam','1995-10-27','A','Belum Kawin','12345722','89751267','12300','1'),
    ('people-MBLE-190349','AKHMAD PANJI PRAYOGO','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','1999-10-15','O','Belum Kawin','12345723','89751268','12300','1'),
    ('people-MBLE-170239','SLAMET WINARTO','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','1977-04-04','O','Kawin','12345724','89751269','12300','1'),
    ('people-MBLE-170247','AHLUL NAJAR','nik_number','kk_number','WNI','Laki-laki','Pulau Tambak','1997-08-26','A','Belum Kawin','12345725','89751270','12300','1'),
    ('people-MBLE-180267','AFIT HAIRUNIAM','nik_number','kk_number','WNI','Laki-laki','Jember','1997-03-29','null','Belum Kawin','12345726','89751271','12300','1'),
    ('people-MBLE-190345','ABDUL DOSI','nik_number','kk_number','WNI','Laki-laki','Palu Rejo','1996-06-08','B','Belum Kawin','12345727','89751272','12300','1'),
    ('people-MBLE-190338','HENGKI IRFANSYAH','nik_number','kk_number','WNI','Laki-laki','Babai','1999-06-17','B','Belum Kawin','12345728','89751273','12300','1'),
    ('people-MBLE-130071','LUKMA NUL HAKIM','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1989-08-22','A','Kawin','12345729','89751274','12300','1'),
    ('people-MBLE-120043','DEDI','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1984-08-08','null','Kawin','12345730','89751275','12300','1'),
    ('people-MBLE-200362','MISRANI','nik_number','kk_number','WNI','Laki-laki','Ruji','1993-06-10','null','Belum Kawin','12345731','89751276','12300','1'),
    ('people-MBLE-190343','MARTIANI','nik_number','kk_number','WNI','Laki-laki','Benangin','1986-07-07','AB','Kawin','12345732','89751277','12300','1'),
    ('people-MBLE-100011','SYAHRUDIN','nik_number','kk_number','WNI','Laki-laki','Pendang','1989-09-04','O','Belum Kawin','12345733','89751278','12300','1'),
    ('people-MBLE-130102','TOHIRIN','nik_number','kk_number','WNI','Laki-laki','Cilacap','1987-02-11','null','Kawin','12345734','89751279','12300','1'),
    ('people-MBLE-130088','SLAMET JUNAIDI','nik_number','kk_number','WNI','Laki-laki','Jember','1975-08-22','null','Kawin','12345735','89751280','12300','1'),
    ('people-MBLE-140139','RIDUAN','nik_number','kk_number','WNI','Laki-laki','Batu Tuhup','1973-01-01','null','Kawin','12345736','89751281','12300','1'),
    ('people-MBLE-190355','KARNADI','nik_number','kk_number','WNI','Laki-laki','Malawaken','1997-07-01','null','Belum Kawin','12345737','89751282','12300','1'),
    ('people-MB/FO-1903080','IRWAN. U','nik_number','kk_number','WNI','Laki-laki','Jakatan Pari','1998-08-12','null','Belum Kawin','12345738','89751283','12300','1'),
    ('people-MB/FO-1904007','BERTOLOMIUS JEHADUT','nik_number','kk_number','WNI','Laki-laki','Manggarai','1999-03-29','null','Belum Kawin','12345739','89751284','12300','1'),
    ('people-MBLE-190329','BENJAMIN WALSON LESNUSSA','nik_number','kk_number','WNI','Laki-laki','Waeturen','1977-03-08','null','Kawin','12345740','89751285','12300','1'),
    ('people-MBLE-200363','HERMANTO','nik_number','kk_number','WNI','Laki-laki','Lehai','1982-01-01','null','Kawin','12345741','89751286','12300','1'),
    ('people-MBLE-130069','SISWANDI PUTRA','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1991-09-09','null','Belum Kawin','12345742','89751287','12300','1'),
    ('people-MBLE-110034','SUPRIADI','nik_number','kk_number','WNI','Laki-laki','Kuala Kapuas','1963-07-22','null','Kawin','12345743','89751288','12300','1'),
    ('people-MBLE-120052','YAKIN FERNANDO','nik_number','kk_number','WNI','Laki-laki','Mamuju','1992-04-23','null','Belum Kawin','12345744','89751289','12300','1'),
    ('people-MBLE-120053','EKO HANDINANTO','nik_number','kk_number','WNI','Laki-laki','Salatiga','1984-12-10','null','Kawin','12345745','89751290','12300','1'),
    ('people-MBLE-130074','WAIL','nik_number','kk_number','WNI','Laki-laki','Indramayu','1970-07-01','B','Kawin','12345746','89751291','12300','1'),
    ('people-MBLE-130075','SUYONO','nik_number','kk_number','WNI','Laki-laki','Magetan','1970-07-02','O','Kawin','12345747','89751292','12300','1'),
    ('people-MBLE-130090','ARAFAH','nik_number','kk_number','WNI','Laki-laki','Sapeng','1973-01-12','A','Kawin','12345748','89751293','12300','1'),
    ('people-MBLE-140117','TRIYONO','nik_number','kk_number','WNI','Laki-laki','Banjarbaru','1972-03-06','AB','Kawin','12345749','89751294','12300','1'),
    ('people-MBLE-140119','YADIN SEMA','nik_number','kk_number','WNI','Laki-laki','Ende','1986-08-26','O','Kawin','12345750','89751295','12300','1'),
    ('people-MBLE-140122','HERI YUDI PRISTIONO','nik_number','kk_number','WNI','Laki-laki','Banjarnegara','1978-07-10','null','Kawin','12345751','89751296','12300','1'),
    ('people-MBLE-180264','USDA','nik_number','kk_number','WNI','Laki-laki','Bintang Ninggi','1976-04-05','null','Kawin','12345752','89751297','12300','1'),
    ('people-MBLE-170228','TONI','nik_number','kk_number','WNI','Laki-laki','Jangkang Baru','1984-07-01','null','Belum Kawin','12345753','89751298','12300','1'),
    ('people-MBLE-140130','ROKIM','nik_number','kk_number','WNI','Laki-laki','Salatiga','1986-05-07','null','Kawin','12345754','89751299','12300','1'),
    ('people-MBLE-180302','SOLIHIN NOOR','nik_number','kk_number','WNI','Laki-laki','Lemo II','1994-10-24','null','Belum Kawin','12345755','89751300','12300','1'),
    ('people-MBLE-100012','RUDI H. ASMUNI','nik_number','kk_number','WNI','Laki-laki','Lemo II','1970-08-20','null','Kawin','12345756','89751301','12300','1'),
    ('people-MBLE-130082','DESIANTO','nik_number','kk_number','WNI','Laki-laki','Ruji','1982-12-07','O','Kawin','12345757','89751302','12300','1'),
    ('people-MBLE-130086','THOMASO DWI JAYANTO','nik_number','kk_number','WNI','Laki-laki','Suatu Baru','1983-04-23','null','Kawin','12345758','89751303','12300','1'),
    ('people-MBLE-02191110098','SANDI','nik_number','kk_number','WNI','Laki-laki','Murung Raya','1991-12-21','null','Belum Kawin','12345759','89751304','12300','1'),
    ('people-MBLE-110036','ISNI','nik_number','kk_number','WNI','Laki-laki','Magetan','1958-04-17','null','Belum Kawin','12345760','89751305','12300','1'),
    ('people-MBLE-200369','SAMSUL ARIEF','nik_number','kk_number','WNI','Laki-laki','Malang','2020-08-01','null','Kawin','12345761','89751306','12300','1'),
    ('people-MBLE-170220','ALDI NOVIT','nik_number','kk_number','WNI','Laki-laki','Jambu','1999-08-20','O','Belum Kawin','12345762','89751307','12300','1'),
    ('people-MBLE-200370','TIARA NAULI MUSTIKA E. N.','nik_number','kk_number','WNI','Perempuan','Palangka Raya','1997-06-25','O','Belum Kawin','12345763','89751308','12300','1'),
    ('people-MBLE-200372','UMILASARI','nik_number','kk_number','WNI','Perempuan','Tumpung Laung I','2002-01-03','O','Belum Kawin','12345764','89751309','12300','1'),
    ('people-MBLE-200374','WAWAN IRAWADI','nik_number','kk_number','WNI','Laki-laki','Kuala Kurun','1973-12-15','B','Kawin','12345765','89751310','12300','1'),
    ('people-MBLE-200375','ABDUL FAKAR','nik_number','kk_number','WNI','Laki-laki','Palangka Raya','1996-05-08','O','Belum Kawin','12345766','89751311','12300','1'),
    ('people-MBLE-200376','LORENSIUS','nik_number','kk_number','WNI','Laki-laki','Palu Rejo','1997-08-18','A','Belum Kawin','12345767','89751312','12300','1'),
    ('people-MBLE-200378','PERYADI','nik_number','kk_number','WNI','Laki-laki','Jingah','1985-06-06','O','Duda','12345768','89751313','12300','1'),
    ('people-MB/F01-180154','MILKEAK','nik_number','kk_number','WNI','Laki-laki','Malawaken','2000-11-06','null','Belum Kawin','12345769','89751314','12300','1'),
    ('people-MBLE-200379','MICHAEL','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2002-04-12','null','Belum Kawin','12345770','89751315','12300','1'),
    ('people-MBLE-200382','RIZKI RIVALDI','nik_number','kk_number','WNI','Laki-laki','Malang','2001-04-19','B','Belum Kawin','12345771','89751316','12300','1'),
    ('people-MBLE-200384','REVINO ADIYATMO','nik_number','kk_number','WNI','Laki-laki','Wonogiri','2000-02-08','null','Belum Kawin','12345772','89751317','12300','1'),
    ('people-MBLE-120020','DENNY P. A. TANJUNG','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1984-02-27','null','Kawin','12345773','89751318','12300','1'),
    ('people-MBLE-140131','MIKRO','nik_number','kk_number','WNI','Laki-laki','Pepas','1993-10-27','null','Belum Kawin','12345774','89751319','12300','1'),
    ('people-MBLE-0220020110 ','SAMSUL ARIFIN','nik_number','kk_number','WNI','Laki-laki','Nganjuk','1986-06-27','null','Belum Kawin','12345775','89751320','12300','1'),
    ('people-MBLE-130101 ','M. YUSUF WAHYU','nik_number','kk_number','WNI','Laki-laki','Malawaken','1978-10-28','null','Belum Kawin','12345776','89751321','12300','1'),
    ('people-MBLE-170185','AMSORI','nik_number','kk_number','WNI','Laki-laki','Jember','1973-05-06','null','Belum Kawin','12345777','89751322','12300','1'),
    ('people-MBLE-170238','UNGGUL UTOMO','nik_number','kk_number','WNI','Laki-laki','Madiun','1975-01-01','null','Belum Kawin','12345778','89751323','12300','1'),
    ('people-MBLE-0219040032','JUNARDI','nik_number','kk_number','WNI','Laki-laki','Lemo','1990-06-02','null','Belum Kawin','12345779','89751324','12300','1'),
    ('people-MBLE-0219080058','ROMA','nik_number','kk_number','WNI','Laki-laki','Muara Inu','1988-09-11','null','Belum Kawin','12345780','89751325','12300','1'),
    ('people-MBLE-0219110100','SUPRIADI','nik_number','kk_number','WNI','Laki-laki','Luwe Hilir','1977-04-11','null','Belum Kawin','12345781','89751326','12300','1'),
    ('people-MBLE-210389','BENSI','nik_number','kk_number','WNI','Laki-laki','Pepas','1967-07-01','O','Kawin','12345782','89751327','12300','1'),
    ('people-MBLE-210390','AHMAD FAUZI','nik_number','kk_number','WNI','Laki-laki','Pepas','2001-04-12','B','Belum Kawin','12345783','89751328','12300','1'),
    ('people-MBLE-210391','HARDIONO','nik_number','kk_number','WNI','Laki-laki','Pepas','1980-10-18','null','Kawin','12345784','89751329','12300','1'),
    ('people-MBLE-210392','SUDIGIO','nik_number','kk_number','WNI','Laki-laki','Pepas','1974-05-10','B','Kawin','12345785','89751330','12300','1'),
    ('people-MBLE-170227','TONI','nik_number','kk_number','WNI','Laki-laki','Majangkan','1983-07-03','null','Belum Kawin','12345786','89751331','12300','1'),
    ('people-MBLE-0219100080','MORA H','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1983-09-24','null','Belum Kawin','12345787','89751332','12300','1'),
    ('people-MBLE-0220060116','HERI IRWANDI','nik_number','kk_number','WNI','Laki-laki','Muara Lahei','1992-02-20','null','Belum Kawin','12345788','89751333','12300','1'),
    ('people-MBLE-210306','DARMIATI NINGSIH','nik_number','kk_number','WNI','Perempuan','-','2000-08-28','null','Belum Kawin','12345789','89751334','12300','1'),
    ('people-MBLE-0219080061','DIDI RIADI','nik_number','kk_number','WNI','Laki-laki','Haragandang','1990-02-20','null','Belum Kawin','12345790','89751335','12300','1'),
    ('people-MBLE-0219120106','HENDRA SISWANDI','nik_number','kk_number','WNI','Laki-laki','Muara Lahei','1999-08-15','null','Belum Kawin','12345791','89751336','12300','1'),
    ('people-MBLE-140121','TORIANSYAH','nik_number','kk_number','WNI','Laki-laki','Tarusan','1982-01-15','null','Belum Kawin','12345792','89751337','12300','1'),
    ('people-MBLE-0219010015','KARIADI','nik_number','kk_number','WNI','Laki-laki','Tarusan','1990-10-01','B','Belum Kawin','12345793','89751338','12300','1'),
    ('people-MBLE-0220010107','YASIN HAMID','nik_number','kk_number','WNI','Laki-laki','Ende','1983-12-23','AB','Kawin','12345794','89751339','12300','1'),
    ('people-MBLE-140116','SUMANTRI','nik_number','kk_number','WNI','Laki-laki','NON','2000-08-28','null','Belum Kawin','12345795','89751340','12300','1'),
    ('people-MBLE-0220010109','UUT MILASARI','nik_number','kk_number','WNI','Perempuan','Hajak','2003-09-06','null','Belum Kawin','12345796','89751341','12300','1'),
    ('people-MBHO-HL004','RESNAWATI','nik_number','kk_number','WNI','Perempuan','Muara Teweh','1998-07-26','A','Kawin','12345797','89751342','12300','1'),
    ('people-MBLE-210394','SAFRIANSYAH','nik_number','kk_number','WNI','Laki-laki','Hadil Suruk','1990-02-01','AB','Kawin','12345798','89751343','12300','1'),
    ('people-MBLE-210396','RIO PRATORIUS','nik_number','kk_number','WNI','Laki-laki','Pararapak','1999-06-14','A','Belum Kawin','12345799','89751344','12300','1'),
    ('people-MBLE-210407','ANITA','nik_number','kk_number','WNI','Perempuan','Haragandang','1975-02-14','A','Kawin','12345800','89751345','12300','1'),
    ('people-MBLE-210397','FRANS SETIA DANI IRAWAN','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','1993-04-25','A','Belum Kawin','12345801','89751346','12300','1'),
    ('people-MBLE-210399','KAMARUDIN','nik_number','kk_number','WNI','Laki-laki','Bintang Ninggi','1999-10-21','null','Kawin','12345802','89751347','12300','1'),
    ('people-MBLE-210401','M. A. HAIRUL SALEH','nik_number','kk_number','WNI','Laki-laki','Manggala','1997-04-28','A','Belum Kawin','12345803','89751348','12300','1'),
    ('people-MBLE-210405','SUWAJI','nik_number','kk_number','WNI','Laki-laki','Madiun','1977-05-05','A','Belum Kawin','12345804','89751349','12300','1'),
    ('people-MBLE-210411','ALDI ALPIANTO','nik_number','kk_number','WNI','Laki-laki','Sikui','2001-06-21','AB','Belum Kawin','12345805','89751350','12300','1'),
    ('people-MBLE-210412','MUHAMMAD HERIYADI','nik_number','kk_number','WNI','Laki-laki','Kalanis','2001-01-10','O','Belum Kawin','12345806','89751351','12300','1'),
    ('people-MBLE-210413','JAYADI','nik_number','kk_number','WNI','Laki-laki','Muara Inu','1986-12-12','A','Kawin','12345807','89751352','12300','1'),
    ('people-MBLE-210415','RAY FAKSI JALADARA','nik_number','kk_number','WNI','Laki-laki','Pangkalan Bun','1998-11-30','O','Belum Kawin','12345808','89751353','12300','1'),
    ('people-MBLE-210416','MUHAMMAD YUSUF','nik_number','kk_number','WNI','Laki-laki','Pangkalan Brandan','1991-07-27','B','Kawin','12345809','89751354','12300','1'),
    ('people-MBLE-210417','BRAND','nik_number','kk_number','WNI','Laki-laki','Kayumban','1982-07-05','A','Kawin','12345810','89751355','12300','1'),
    ('people-MBLE-210418','BENI SETIAWAN','nik_number','kk_number','WNI','Laki-laki','Pepas','2001-01-16','O','Belum Kawin','12345811','89751356','12300','1'),
    ('people-MBLE-210419','SAMSUDIN NUSA SANGGU','nik_number','kk_number','WNI','Laki-laki','Maubasa','2000-12-25','AB','Belum Kawin','12345812','89751357','12300','1'),
    ('people-MBLE-210420','MUHAMMAD MULYADI','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','1997-08-14','A','Belum Kawin','12345813','89751358','12300','1'),
    ('people-MBLE-210422','MAHDIANOR','nik_number','kk_number','WNI','Laki-laki','Kuripan','1984-11-02','O','Kawin','12345814','89751359','12300','1'),
    ('people-MBLE-210426','ARYA WEDA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2000-12-30','O','Kawin','12345815','89751360','12300','1'),
    ('people-MB/F01-150060','EDYANTO SUBARI','nik_number','kk_number','WNI','Laki-laki','Juju Baru','1969-09-11','A','Kawin','12345816','89751361','12300','1'),
    ('people-MBLE-210427','SUYATI','nik_number','kk_number','WNI','Perempuan','Tapin','1973-02-04','B','Janda','12345817','89751362','12300','1'),
    ('people-MBLE-210428','RAHMAD RAGIL SANTOSO','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','2000-09-15','B','Belum Kawin','12345818','89751363','12300','1'),
    ('people-MBLE-210429','MARADONA','nik_number','kk_number','WNI','Laki-laki','Marawan Lama','1990-05-16','null','Kawin','12345819','89751364','12300','1'),
    ('people-MBLE-210430','SUNARTO','nik_number','kk_number','WNI','Laki-laki','Trenggalek','1975-12-23','null','Kawin','12345820','89751365','12300','1'),
    ('people-MBLE-210431','INDRA','nik_number','kk_number','WNI','Laki-laki','Hajak','2021-01-15','O','Belum Kawin','12345821','89751366','12300','1'),
    ('people-MBLE-210432','ANGLING PRATAMA','nik_number','kk_number','WNI','Laki-laki','Kamawen','2003-02-19','null','Belum Kawin','12345822','89751367','12300','1'),
    ('people-MBLE-210433','DONY ANGGA SETIYO','nik_number','kk_number','WNI','Laki-laki','Lahei','1975-11-16','B','Kawin','12345823','89751368','12300','1'),
    ('people-MBLE-210435','WIDODO','nik_number','kk_number','WNI','Laki-laki','Bojonegoro','1977-03-12','O','Kawin','12345824','89751369','12300','1'),
    ('people-MBLE-210436','ALEK ERDIANTO','nik_number','kk_number','WNI','Laki-laki','Purworejo','1984-01-21','AB','Duda','12345825','89751370','12300','1'),
    ('people-MBLE-210437','AGUS JULIANTO','nik_number','kk_number','WNI','Laki-laki','Batu Raya','2003-07-06','null','Belum Kawin','12345826','89751371','12300','1'),
    ('people-MBLE-140143','BUSTAMI ARIFIN','nik_number','kk_number','WNI','Laki-laki','Wonorejo','1986-04-06','null','Belum Kawin','12345827','89751372','12300','1'),
    ('people-MB/F01-190179','FATUR RAHMAN','nik_number','kk_number','WNI','Laki-laki','Malawaken','1999-01-04','null','Belum Kawin','12345828','89751373','12300','1'),
    ('people-MBLE-210441','BETLYANOR','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','1997-07-05','null','Belum Kawin','12345829','89751374','12300','1'),
    ('people-MBLE-210447','AMORI VALDA','nik_number','kk_number','WNI','Laki-laki','Barito Selatan','1998-09-28','B','Belum Kawin','12345830','89751375','12300','1'),
    ('people-MBLE-210449','MAMAT SASMITA','nik_number','kk_number','WNI','Laki-laki','Tanjung','1970-10-01','B','Kawin','12345831','89751376','12300','1'),
    ('people-MBLE-210452','NORHALIMAH','nik_number','kk_number','WNI','Perempuan','Muara Laung I','1998-09-03','B','Janda','12345832','89751377','12300','1'),
    ('people-MBLE-210453','RAHUL PANGESTU','nik_number','kk_number','WNI','Laki-laki','Batu Raya','2002-03-02','B','Belum Kawin','12345833','89751378','12300','1'),
    ('people-MBLE-210456','SIPRIN SURYADI','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung II','1990-07-16','null','Kawin','12345834','89751379','12300','1'),
    ('people-MBLE-210458','NURHIDAYAT DARSIMAN','nik_number','kk_number','WNI','Laki-laki','Cilacap','1966-05-02','null','Kawin','12345835','89751380','12300','1'),
    ('people-MBLE-210460','BASUKI SUPRIYATIN','nik_number','kk_number','WNI','Laki-laki','Malang','1967-05-02','AB','Kawin','12345836','89751381','12300','1'),
    ('people-MBLE-210461','SUJENDRO','nik_number','kk_number','WNI','Laki-laki','Blora','1964-11-01','null','Kawin','12345837','89751382','12300','1'),
    ('people-MBLE-210466','ALKHAMAD','nik_number','kk_number','WNI','Laki-laki','Banjarnegara','1969-04-07','A','Kawin','12345838','89751383','12300','1'),
    ('people-MBLE-210467','DESSY AYU PERMATASARI','nik_number','kk_number','WNI','Perempuan','Blitar','1996-12-01','O','Belum Kawin','12345839','89751384','12300','1'),
    ('people-MBLE-210434','TRI SUSANTO','nik_number','kk_number','WNI','Laki-laki','Lemo','1989-04-23','A','Kawin','12345840','89751385','12300','1'),
    ('people-MBLE-180296','AKHMAD JAYA SAPUTRA','nik_number','kk_number','WNI','Laki-laki','Pendang','1996-10-13','null','Kawin','12345841','89751386','12300','1'),
    ('people-MBLE-210446','SUKANTO','nik_number','kk_number','WNI','Laki-laki','Panarukan','1999-06-30','null','Belum Kawin','12345842','89751387','12300','1'),
    ('people-MBLE-210469','AHMAD FAJRI','nik_number','kk_number','WNI','Perempuan','Kalanis','1999-05-10','O','Belum Kawin','12345843','89751388','12300','1'),
    ('people-MBLE-210470','PIATUN','nik_number','kk_number','WNI','Laki-laki','Pendreh','2000-03-24','null','Belum Kawin','12345844','89751389','12300','1'),
    ('people-MBLE-210471','AMIR','nik_number','kk_number','WNI','Laki-laki','Lemo II','2003-03-05','null','Belum Kawin','12345845','89751390','12300','1'),
    ('people-MB/F01-150075','SUNARYO','nik_number','kk_number','WNI','Laki-laki','Pekalongan','1961-07-28','null','Duda','12345846','89751391','12300','1'),
    ('people-MBLE-140132','SUPRIADI','nik_number','kk_number','WNI','Laki-laki','Bintang Ninggi','1984-05-24','null','Belum Kawin','12345847','89751392','12300','1'),
    ('people-MBLE-210479','SUDIRMAN','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1970-10-07','O','Kawin','12345848','89751393','12300','1'),
    ('people-MBLE-210480','AKONG SUNARDI','nik_number','kk_number','WNI','Laki-laki','Paring Lahung','1980-10-22','O','Kawin','12345849','89751394','12300','1'),
    ('people-MBLE-210482','MUHAMMAD ALI AKBAR','nik_number','kk_number','WNI','Laki-laki','Jambu','2002-03-01','null','Belum Kawin','12345850','89751395','12300','1'),
    ('people-MBLE-210484','DIMAS RIZKI PANGESTU','nik_number','kk_number','WNI','Laki-laki','Cilacap','1997-05-12','B','Belum Kawin','12345851','89751396','12300','1'),
    ('people-MBLE-210486','DIDIK KHOIRURROHMAN','nik_number','kk_number','WNI','Laki-laki','Gresik','1998-03-21','null','Belum Kawin','12345852','89751397','12300','1'),
    ('people-MBLE-210489','MARSONO','nik_number','kk_number','WNI','Laki-laki','Banyumas','1982-06-07','null','Kawin','12345853','89751398','12300','1'),
    ('people-MBLE-210491','NIPON SLAMET','nik_number','kk_number','WNI','Laki-laki','Wonosobo','1981-11-03','null','Kawin','12345854','89751399','12300','1'),
    ('people-MBLE-210493','AGUS SUPRIYANTO','nik_number','kk_number','WNI','Laki-laki','Malang','1972-07-25','AB','Kawin','12345855','89751400','12300','1'),
    ('people-MBLE-210494','SOBANDI','nik_number','kk_number','WNI','Laki-laki','Cianjur','1985-01-10','null','Kawin','12345856','89751401','12300','1'),
    ('people-MBLE-210496','M. ASWADINNOR','nik_number','kk_number','WNI','Laki-laki','Lemo II','2003-06-02','null','Belum Kawin','12345857','89751402','12300','1'),
    ('people-MBET-2111010012','AMY SAPUTRA','nik_number','kk_number','WNI','Laki-laki','Lemo II','1993-05-21','O','Kawin','12345858','89751403','12300','1'),
    ('people-MBLE-210500','NAWIS','nik_number','kk_number','WNI','Laki-laki','Muara Tuhup','1972-10-01','null','Kawin','12345859','89751404','12300','1'),
    ('people-MBLE-210501','MARINDRA PAMUNGKAS','nik_number','kk_number','WNI','Laki-laki','Cilacap','1997-03-19','null','Belum Kawin','12345860','89751405','12300','1'),
    ('people-MBET-2111010013','HURLANDO KILAI MAKET','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2001-04-06','null','Belum Kawin','12345861','89751406','12300','1'),
    ('people-MBLE-210502','RAHMAT HIDAYAT','nik_number','kk_number','WNI','Laki-laki','Mengkatip','1992-11-25','O','Kawin','12345862','89751407','12300','1'),
    ('people-MBLE-210503','KRIS MUNANDAR','nik_number','kk_number','WNI','Laki-laki','Komplek Jahon','1999-04-04','null','Belum Kawin','12345863','89751408','12300','1'),
    ('people-MBLE-210507','RAFIT HERI BUDI CAHYONO','nik_number','kk_number','WNI','Laki-laki','Pangkalan Bun','1989-10-05','null','Kawin','12345864','89751409','12300','1'),
    ('people-MBLE-210508','ANANG FAUZI','nik_number','kk_number','WNI','Laki-laki','Batu Tuhup','1973-05-02','O','Kawin','12345865','89751410','12300','1'),
    ('people-MB/F01-110023','JHONI','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12345866','89751411','12300','1'),
    ('people-MBLE-120046','HUSIN','nik_number','kk_number','WNI','Laki-laki','Pendreh','1986-08-07','null','Kawin','12345867','89751412','12300','1'),
    ('people-MBLE-210517','EFIN DWI KRISTIANTO','nik_number','kk_number','WNI','Laki-laki','Cilacap','1975-09-18','null','Kawin','12345868','89751413','12300','1'),
    ('people-MBLE-210519','ROBERT DOVIE PERMANA','nik_number','kk_number','WNI','Laki-laki','Cilacap','1997-08-10','null','Belum Kawin','12345869','89751414','12300','1'),
    ('people-MBLE-220522','SUMIATI','nik_number','kk_number','WNI','Perempuan','Muara Laung II','1993-03-01','O','Belum Kawin','12345870','89751415','12300','1'),
    ('people-MB/HO-140034','RUSLIANSYAH','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12345871','89751416','12300','1'),
    ('people-MBLE-220524','RAMADHAN EKA SAPUTRA','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','2003-11-23','null','Belum Kawin','12345872','89751417','12300','1'),
    ('people-MBLE-220525','YOGI SASMITA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1994-07-09','B','Kawin','12345873','89751418','12300','1'),
    ('people-MBLE-220526','ADE HANDRIAH SUPANTON','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1995-06-11','null','Kawin','12345874','89751419','12300','1'),
    ('people-MBLE-220527','SAIPULLAH','nik_number','kk_number','WNI','Laki-laki','Panyiuran','1994-07-17','B','Kawin','12345875','89751420','12300','1'),
    ('people-MBLE-220528','RUSMAYANTI','nik_number','kk_number','WNI','Perempuan','Babai','1985-06-08','null','Belum Kawin','12345876','89751421','12300','1'),
    ('people-MBLE-220529','ALI WIJAYA','nik_number','kk_number','WNI','Laki-laki','Ruji','1999-11-24','B','Belum Kawin','12345877','89751422','12300','1'),
    ('people-MBLE-200373','MENTARI','nik_number','kk_number','WNI','Perempuan','Penda Asam','2002-08-11','O','Belum Kawin','12345878','89751423','12300','1'),
    ('people-MBLE-220530','ASWAN BAIDAWI','nik_number','kk_number','WNI','Laki-laki','Montallat II','1987-11-23','O','Kawin','12345879','89751424','12300','1'),
    ('people-MBLE-220531','YANEN','nik_number','kk_number','WNI','Laki-laki','Amparbur','1967-12-27','A','Kawin','12345880','89751425','12300','1'),
    ('people-MBLE-220533','EGI','nik_number','kk_number','WNI','Laki-laki','Lemo','1991-01-17','null','Kawin','12345881','89751426','12300','1'),
    ('people-MBLE-220534','LEOBARDUS ROHBINTO','nik_number','kk_number','WNI','Laki-laki','Palu Rejo','1998-04-02','null','Belum Kawin','12345882','89751427','12300','1'),
    ('people-MBLE-220535','ALMANDANI','nik_number','kk_number','WNI','Laki-laki','Rodok','2000-02-04','null','Belum Kawin','12345883','89751428','12300','1'),
    ('people-MBLE-220536','PERMADI NATA WIJAYA','nik_number','kk_number','WNI','Laki-laki','Linggang Bigung','1999-03-06','null','Belum Kawin','12345884','89751429','12300','1'),
    ('people-MBLE-220538','AKHMAD WARTOYO','nik_number','kk_number','WNI','Laki-laki','Banjar Negara','1984-05-17','null','Kawin','12345885','89751430','12300','1'),
    ('people-MBLE-220539','MELKY HARY SANDY LATUPAPUA','nik_number','kk_number','WNI','Laki-laki','Banjarmasin','1995-03-05','B','Belum Kawin','12345886','89751431','12300','1'),
    ('people-MBLE-220540','RENOD PURIANTO','nik_number','kk_number','WNI','Laki-laki','Jingah','1983-09-14','A','Kawin','12345887','89751432','12300','1'),
    ('people-MBLE-220541','ROYADI','nik_number','kk_number','WNI','Laki-laki','Ipu','1982-06-13','null','Kawin','12345888','89751433','12300','1'),
    ('people-MBLE-220545','MUHKTI GANI','nik_number','kk_number','WNI','Laki-laki','Montallat II','1976-06-05','AB','Duda','12345889','89751434','12300','1'),
    ('people-MBLE-220546','RAMAYADI','nik_number','kk_number','WNI','Laki-laki','Paya Bakung','1986-05-20','null','Belum Kawin','12345890','89751435','12300','1'),
    ('people-MBLE-220547','EDY SATRIONO','nik_number','kk_number','WNI','Laki-laki','Marapit','1978-02-06','A','Kawin','12345891','89751436','12300','1'),
    ('people-MBLE-220548','IRFAN HELMI AMRULLAH','nik_number','kk_number','WNI','Laki-laki','Sleman','2000-02-12','B','Belum Kawin','12345892','89751437','12300','1'),
    ('people-MBLE-220549','YUDHI PRANATA','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12345893','89751438','12300','1'),
    ('people-MBLE-220551','RIDA','nik_number','kk_number','WNI','Perempuan','Tatakan','1999-04-27','null','Belum Kawin','12345894','89751439','12300','1'),
    ('people-MBLE-220553','KORNELIA RISKA RIYANTO','nik_number','kk_number','WNI','Perempuan','Tabalong','2001-01-26','B','Belum Kawin','12345895','89751440','12300','1'),
    ('people-MBLE-220554','IRA PUTRI UTAMI','nik_number','kk_number','WNI','Perempuan','Default','2000-08-28','null','Belum Kawin','12345896','89751441','12300','1'),
    ('people-MBLE-220556','JALALLUDIN','nik_number','kk_number','WNI','Laki-laki','Paring Lahung','1980-09-11','A','Kawin','12345897','89751442','12300','1'),
    ('people-MBLE-220557','HIDAYATULLAH','nik_number','kk_number','WNI','Laki-laki','Bambulung','1988-04-29','null','Kawin','12345898','89751443','12300','1'),
    ('people-MBLE-220560','DEDEN NAJMUDIN','nik_number','kk_number','WNI','Laki-laki','Garut','1968-05-05','null','Kawin','12345899','89751444','12300','1'),
    ('people-MBLE-220563','HADRIANSYAH','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1985-02-22','O','Kawin','12345900','89751445','12300','1'),
    ('people-MBLE-220564','ABDULLAH SANI','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1978-07-10','null','Kawin','12345901','89751446','12300','1'),
    ('people-MBLE-220565','MAHLUPI','nik_number','kk_number','WNI','Laki-laki','Lemo II','1998-11-06','null','Belum Kawin','12345902','89751447','12300','1'),
    ('people-MBLE-220566','AYU LESTARI','nik_number','kk_number','WNI','Perempuan','Rahaden','1994-03-08','B','Janda','12345903','89751448','12300','1'),
    ('people-MBLE-220567','FRANRIA MASTARI','nik_number','kk_number','WNI','Perempuan','Masuparia','1989-06-28','AB','Belum Kawin','12345904','89751449','12300','1'),
    ('people-MBLE-220568','DAVID N. ABIDIN','nik_number','kk_number','WNI','Laki-laki','Malawaken','1960-09-11','B','Kawin','12345905','89751450','12300','1'),
    ('people-MBLE-220570','MERYATI','nik_number','kk_number','WNI','Perempuan','Kananai','2022-03-16','AB','Janda','12345906','89751451','12300','1'),
    ('people-MBLE-220571','KHOIRUN NISA','nik_number','kk_number','WNI','Perempuan','Batu Raya','2003-07-25','null','Belum Kawin','12345907','89751452','12300','1'),
    ('people-MBLE-220725','HARIADI','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12345908','89751453','12300','1'),
    ('people-MBLE-220573','EXSSAN RAHMAT SAPUTRA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2000-08-30','A','Belum Kawin','12345909','89751454','12300','1'),
    ('people-MBLE-220575','AMIR RAHIM','nik_number','kk_number','WNI','Laki-laki','Muara Arai','1997-04-23','O','Belum Kawin','12345910','89751455','12300','1'),
    ('people-MBLE-130096','JOKO PURWANTO','nik_number','kk_number','WNI','Laki-laki','Malang','1975-09-14','null','Kawin','12345911','89751456','12300','1'),
    ('people-MBLE-220576','CICI YUNISA','nik_number','kk_number','WNI','Perempuan','Malawaken','1997-10-06','null','Belum Kawin','12345912','89751457','12300','1'),
    ('people-MBLE-220578','ALDO DWI PAMUNGKAS','nik_number','kk_number','WNI','Laki-laki','Cilacap','2001-03-09','null','Belum Kawin','12345913','89751458','12300','1'),
    ('people-MBLE-220583','SEFTIAN CAHYA WARDANI','nik_number','kk_number','WNI','Perempuan','Marabahan','1994-06-11','A','Kawin','12345914','89751459','12300','1'),
    ('people-MBLE-220584','ESTI ERVILA','nik_number','kk_number','WNI','Perempuan','Ruji','2001-07-07','null','Janda','12345915','89751460','12300','1'),
    ('people-MBLE-220585','SELLY YULIA NINGSIH','nik_number','kk_number','WNI','Perempuan','Baliti','1997-04-23','null','Janda','12345916','89751461','12300','1'),
    ('people-MBLE-220586','NUNIYATI','nik_number','kk_number','WNI','Perempuan','Default','2000-08-28','null','Belum Kawin','12345917','89751462','12300','1'),
    ('people-MBLE-220587','LOMAYANA NIRMILA ARANDA','nik_number','kk_number','WNI','Perempuan','Hingan','1998-04-20','A','Janda','12345918','89751463','12300','1'),
    ('people-MBLE-220588','MAULIDAH','nik_number','kk_number','WNI','Perempuan','Babai','2001-08-19','null','Belum Kawin','12345919','89751464','12300','1'),
    ('people-MBLE-220589','RIATUL JANNAH','nik_number','kk_number','WNI','Perempuan','Babai','2001-12-27','null','Belum Kawin','12345920','89751465','12300','1'),
    ('people-MBLE-220591','FELISTYA ADIYATAMA','nik_number','kk_number','WNI','Laki-laki','Wonogiri','2002-08-06','null','Belum Kawin','12345921','89751466','12300','1'),
    ('people-MBLE-220599','SAMSUL ARIFIN','nik_number','kk_number','WNI','Laki-laki','Surabaya','1969-02-03','A','Kawin','12345922','89751467','12300','1'),
    ('people-MBLE-220592','TEDY IMRAN','nik_number','kk_number','WNI','Laki-laki','Penda Asam','2003-06-07','null','Belum Kawin','12345923','89751468','12300','1'),
    ('people-MBLE-220593','BAMBANG','nik_number','kk_number','WNI','Laki-laki','Dirung Lingkin','2022-04-27','O','Kawin','12345924','89751469','12300','1'),
    ('people-MBLE-220594','UJI','nik_number','kk_number','WNI','Laki-laki','Hajak','1998-02-06','B','Kawin','12345925','89751470','12300','1'),
    ('people-MBLE-220595','RIKY WILDAYANTO','nik_number','kk_number','WNI','Laki-laki','Hajak','2000-09-29','AB','Belum Kawin','12345926','89751471','12300','1'),
    ('people-MBLE-220596','YEHUDA BILL GUTHERES','nik_number','kk_number','WNI','Laki-laki','Hajak','2000-05-20','B','Belum Kawin','12345927','89751472','12300','1'),
    ('people-MBLE-220601','AHMAD JULKURNAIN','nik_number','kk_number','WNI','Laki-laki','Pendang','2002-09-23','B','Belum Kawin','12345928','89751473','12300','1'),
    ('people-MBLE-220602','ITA NORRAHMAH','nik_number','kk_number','WNI','Perempuan','Tumbang Masao','1999-02-21','B','Belum Kawin','12345929','89751474','12300','1'),
    ('people-MBLE-220606','SURIANSYAH','nik_number','kk_number','WNI','Laki-laki','Buntok','1992-10-14','O','Kawin','12345930','89751475','12300','1'),
    ('people-MBLE-220603','LENNY SYABIKA','nik_number','kk_number','WNI','Perempuan','Puruk Cahu','2001-11-10','null','Belum Kawin','12345931','89751476','12300','1'),
    ('people-MBLE-220604','RAHDIANOR RUSTAM','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2000-02-09','O','Belum Kawin','12345932','89751477','12300','1'),
    ('people-MBLE-220607','JONSON','nik_number','kk_number','WNI','Laki-laki','Hajak','2000-02-03','AB','Belum Kawin','12345933','89751478','12300','1'),
    ('people-MBLE-220608','SRI RAHMAWATI','nik_number','kk_number','WNI','Perempuan','Kuala Pambuang','1995-09-28','O','Belum Kawin','12345934','89751479','12300','1'),
    ('people-MBLE-220609','MELIANCE','nik_number','kk_number','WNI','Laki-laki','Hajak','1996-05-14','B','Kawin','12345935','89751480','12300','1'),
    ('people-MBLE-220610','FIQRI RAHMAN','nik_number','kk_number','WNI','Perempuan','Tamban Baru Timur','1994-06-10','null','Kawin','12345936','89751481','12300','1'),
    ('people-MBLE-220613','LERIANTO','nik_number','kk_number','WNI','Laki-laki','Trinsing','1992-10-23','null','Belum Kawin','12345937','89751482','12300','1'),
    ('people-MBLE-220616','ZAINUDIN','nik_number','kk_number','WNI','Laki-laki','Buntok','1996-01-05','B','Kawin','12345938','89751483','12300','1'),
    ('people-MBLE-220617','MUKHAMAD NURDIN','nik_number','kk_number','WNI','Laki-laki','Jakarta','1974-10-14','O','Kawin','12345939','89751484','12300','1'),
    ('people-MBLE-220618','JAMALUDHIN TRI HARTANTO','nik_number','kk_number','WNI','Laki-laki','Cilacap','1998-04-17','A','Belum Kawin','12345940','89751485','12300','1'),
    ('people-MBLE-220622','SUTRIYONO','nik_number','kk_number','WNI','Laki-laki','Cilacap','2000-10-26','O','Belum Kawin','12345941','89751486','12300','1'),
    ('people-MBLE-220626','KARSO ISWANTO','nik_number','kk_number','WNI','Laki-laki','Cilacap','1964-08-25','O','Kawin','12345942','89751487','12300','1'),
    ('people-MBLE-220627','SURATMIN','nik_number','kk_number','WNI','Laki-laki','Sragen','1975-08-11','O','Kawin','12345943','89751488','12300','1'),
    ('people-MBLE-220628','MUHAMAD SUPRI','nik_number','kk_number','WNI','Laki-laki','Default','1994-09-30','null','Kawin','12345944','89751489','12300','1'),
    ('people-MBLE-220629','RUDI HARTONO','nik_number','kk_number','WNI','Laki-laki','Malang','1971-03-02','A','Kawin','12345945','89751490','12300','1'),
    ('people-MBLE-220631','YULUS ELHERMADA','nik_number','kk_number','WNI','Laki-laki','Malawaken','2003-07-28','null','Belum Kawin','12345946','89751491','12300','1'),
    ('people-MBLE-220632','MARIANTO','nik_number','kk_number','WNI','Laki-laki','Malawaken','2000-08-28','null','Kawin','12345947','89751492','12300','1'),
    ('people-MBLE-220633','YANTI','nik_number','kk_number','WNI','Perempuan','Hajak','1986-12-11','null','Kawin','12345948','89751493','12300','1'),
    ('people-MBLE-220635','MELLIANI DESVITA SARI','nik_number','kk_number','WNI','Perempuan','Sungai Liput','2022-02-01','O','Belum Kawin','12345949','89751494','12300','1'),
    ('people-MBLE-220636','NUR AULIA TESSA','nik_number','kk_number','WNI','Perempuan','Tumpung Laung','2002-02-09','A','Belum Kawin','12345950','89751495','12300','1'),
    ('people-MBLE-220638','MUHAMAD FIKRI','nik_number','kk_number','WNI','Laki-laki','Barabai','2000-01-13','B','Belum Kawin','12345951','89751496','12300','1'),
    ('people-MBLE-220639','JENLI','nik_number','kk_number','WNI','Laki-laki','Hajak','2003-01-08','null','Belum Kawin','12345952','89751497','12300','1'),
    ('people-MBLE-220640','HARIONO','nik_number','kk_number','WNI','Laki-laki','Bintang Ninggi','2000-08-28','B','Kawin','12345953','89751498','12300','1'),
    ('people-MBLE-220641','AKHMAD JUDIUS','nik_number','kk_number','WNI','Laki-laki','Hajak','1979-08-14','O','Kawin','12345954','89751499','12300','1'),
    ('people-MBLE-220642','SASTRA','nik_number','kk_number','WNI','Laki-laki','Ampah','1994-04-24','null','Belum Kawin','12345955','89751500','12300','1'),
    ('people-MBLE-220643','POPY ANDARESTA','nik_number','kk_number','WNI','Perempuan','Sikan','2004-11-10','O','Belum Kawin','12345956','89751501','12300','1'),
    ('people-MBLE-220644','MUHAMMAD FAJAR BAIHAQI','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2004-01-01','O','Belum Kawin','12345957','89751502','12300','1'),
    ('people-MBLE-220645','TITO CHRISTYANTO','nik_number','kk_number','WNI','Laki-laki','Semarang','1997-01-03','AB','Kawin','12345958','89751503','12300','1'),
    ('people-MBLE-220646','SALAMUDIN','nik_number','kk_number','WNI','Laki-laki','Rikit Gaib','1994-04-21','AB','Kawin','12345959','89751504','12300','1'),
    ('people-MBLE-220647','NUR HUDA ABDULLOH','nik_number','kk_number','WNI','Laki-laki','Tulungagung','1988-10-22','null','Kawin','12345960','89751505','12300','1'),
    ('people-MBLE-220648','DATAI ROLIN','nik_number','kk_number','WNI','Laki-laki','Jingah','1985-09-09','null','Kawin','12345961','89751506','12300','1'),
    ('people-MBLE-220649','JABARDIN','nik_number','kk_number','WNI','Laki-laki','Malawaken','1979-08-20','A','Kawin','12345962','89751507','12300','1'),
    ('people-MBLE-220650','DWIDA RUKMANA INDAH LESTARI','nik_number','kk_number','WNI','Perempuan','Muara Teweh','1999-10-19','A','Belum Kawin','12345963','89751508','12300','1'),
    ('people-MBLE-220651','NURIL ARPAH','nik_number','kk_number','WNI','Perempuan','Lemo II','1999-10-23','A','Belum Kawin','12345964','89751509','12300','1'),
    ('people-MBLE-220652','PIKA ADETIA YOLANDA','nik_number','kk_number','WNI','Perempuan','Paring Lahung','1998-02-12','B','Belum Kawin','12345965','89751510','12300','1'),
    ('people-MBLE-220653','EVIE TEEANDANI','nik_number','kk_number','WNI','Perempuan',' Butong','1993-11-29','A','Belum Kawin','12345966','89751511','12300','1'),
    ('people-MBLE-220654','ELMA RIZKA','nik_number','kk_number','WNI','Perempuan','Bukit Sawit','2003-06-03','A','Belum Kawin','12345967','89751512','12300','1'),
    ('people-MBLE-220655','ROSALINA','nik_number','kk_number','WNI','Perempuan','Ipu','1999-03-10','A','Janda','12345968','89751513','12300','1'),
    ('people-MBLE-220656','MITRI YANTI','nik_number','kk_number','WNI','Perempuan','Sibung','1992-09-04','null','Janda','12345969','89751514','12300','1'),
    ('people-MBLE-220657','FENTI YUNIA RATIH','nik_number','kk_number','WNI','Perempuan','Landasan Ulin','2004-06-05','O','Belum Kawin','12345970','89751515','12300','1'),
    ('people-MBLE-220658','SAPNA KURNIA','nik_number','kk_number','WNI','Perempuan','Puruk Cahu','2003-03-02','O','Belum Kawin','12345971','89751516','12300','1'),
    ('people-MBLE-220659','NOVARIA','nik_number','kk_number','WNI','Perempuan','Reong','1999-07-21','null','Belum Kawin','12345972','89751517','12300','1'),
    ('people-MBLE-220660','IRMA','nik_number','kk_number','WNI','Perempuan','KM 26','1998-06-29','B','Belum Kawin','12345973','89751518','12300','1'),
    ('people-MBLE-220661','KRISTIANI','nik_number','kk_number','WNI','Perempuan','KM 26','1998-04-12','O','Belum Kawin','12345974','89751519','12300','1'),
    ('people-MBLE-220662','EKA DARANENGGAR SUKMA WIJAYANTI','nik_number','kk_number','WNI','Perempuan','Blora','2001-06-06','null','Belum Kawin','12345975','89751520','12300','1'),
    ('people-MBLE-220663','INDAH VIRGO RIYANTI','nik_number','kk_number','WNI','Perempuan','Muara Teweh','1994-09-19','O','Kawin','12345976','89751521','12300','1'),
    ('people-MBLE-220664','ENDAH PUJI LESTARI','nik_number','kk_number','WNI','Perempuan','Batuah','2002-09-13','B','Belum Kawin','12345977','89751522','12300','1'),
    ('people-MBLE-220665','DARMASIYAH','nik_number','kk_number','WNI','Perempuan','Muara Teweh','2006-03-29','null','Janda','12345978','89751523','12300','1'),
    ('people-MBLE-220666','BAHRONI','nik_number','kk_number','WNI','Laki-laki','Montallat','1980-06-11','null','Kawin','12345979','89751524','12300','1'),
    ('people-MB/F01-170121','SULAIMAN','nik_number','kk_number','WNI','Laki-laki','Kohong','1967-06-17','null','Kawin','12345980','89751525','12300','1'),
    ('people-MB/F01-150069','MULYADI','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1994-11-20','null','Belum Kawin','12345981','89751526','12300','1'),
    ('people-MBLE-0322010063','SURIANADI','nik_number','kk_number','WNI','Laki-laki','Liang Buah','1986-11-12','null','Belum Kawin','12345982','89751527','12300','1'),
    ('people-MBLE-0322010064','RENDI RIANTO','nik_number','kk_number','WNI','Laki-laki','Pendreh','2001-05-05','null','Belum Kawin','12345983','89751528','12300','1'),
    ('people-MBLE-0322010050','JULKASMITA','nik_number','kk_number','WNI','Laki-laki','Malawaken','1995-06-23','B','Kawin','12345984','89751529','12300','1'),
    ('people-MBLE-0321100004','ERLIAN EFENDI','nik_number','kk_number','WNI','Laki-laki','Lemo','1986-11-05','null','Kawin','12345985','89751530','12300','1'),
    ('people-MBLE-0321110028','MINOTO','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Kawin','12345986','89751531','12300','1'),
    ('people-MBLE-0321110029','DAROJAT','nik_number','kk_number','WNI','Laki-laki','Banjarnegara','1969-06-02','null','Kawin','12345987','89751532','12300','1'),
    ('people-MBLE-0321110032','NATO','nik_number','kk_number','WNI','Laki-laki','Cilacap','1983-05-13','null','Kawin','12345988','89751533','12300','1'),
    ('people-MBLE-0321120047','WANDI','nik_number','kk_number','WNI','Laki-laki','Tanggerang','1988-10-12','B+','Belum Kawin','12345989','89751534','12300','1'),
    ('people-MBLE-0321120043','RIKO DWI INDRAWAN','nik_number','kk_number','WNI','Laki-laki','Blitar','1989-07-05','null','Kawin','12345990','89751535','12300','1'),
    ('people-MBLE-0322010052','DURMANSIUS','nik_number','kk_number','WNI','Laki-laki','Malawaken','1997-03-02','null','Belum Kawin','12345991','89751536','12300','1'),
    ('people-MBLE-0322010058','PRIWANTO','nik_number','kk_number','WNI','Laki-laki','Kandui','1994-03-07','O','Kawin','12345992','89751537','12300','1'),
    ('people-MBLE-0322010067','LAMBANG','nik_number','kk_number','WNI','Laki-laki','Malawaken','1996-06-03','null','Belum Kawin','12345993','89751538','12300','1'),
    ('people-MBLE-0322020070','SALPANI','nik_number','kk_number','WNI','Laki-laki','Malawaken','2000-08-28','null','Belum Kawin','12345994','89751539','12300','1'),
    ('people-MBLE-0321120045','AGUS SUPRIADI','nik_number','kk_number','WNI','Laki-laki','Madiun','1976-08-06','null','Kawin','12345995','89751540','12300','1'),
    ('people-MBLE-0322010060','SAPALIANSON','nik_number','kk_number','WNI','Laki-laki','Malawaken','1971-06-05','O','Kawin','12345996','89751541','12300','1'),
    ('people-MBLE-0321100003','RIZAIN NOOR FIKRI','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1997-05-22','null','Belum Kawin','12345997','89751542','12300','1'),
    ('people-MBLE-0321120048','GATOT WIRANJALI','nik_number','kk_number','WNI','Laki-laki','Nganjuk','1969-02-28','null','Duda','12345998','89751543','12300','1'),
    ('people-MBLE-0322010057','BAMBANG TRIYETNO','nik_number','kk_number','WNI','Laki-laki','Malawaken','1981-10-10','O','Kawin','12345999','89751544','12300','1'),
    ('people-MBLE-0321110040','YANTO','nik_number','kk_number','WNI','Laki-laki','Teweh Tengah','1978-11-30','null','Kawin','12346000','89751545','12300','1'),
    ('people-MBLE-0321100022','MUHAMMAD SALEH YUDI','nik_number','kk_number','WNI','Laki-laki','Buntok','1983-08-23','O','Kawin','12346001','89751546','12300','1'),
    ('people-MBLE-220667','ARBANUS','nik_number','kk_number','WNI','Laki-laki','Kayumban','1988-08-08','O','Duda','12346002','89751547','12300','1'),
    ('people-MBLE-220668','IRWAN EFENDI AMBARITA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','1983-04-11','B','Kawin','12346003','89751548','12300','1'),
    ('people-MBLE-220669','EMAS MONETER SIDI','nik_number','kk_number','WNI','Laki-laki','Sangal','1999-06-15','null','Belum Kawin','12346004','89751549','12300','1'),
    ('people-MBLE-220670','ERI SUTRIADI','nik_number','kk_number','WNI','Laki-laki','Sikan','1986-10-08','A','Belum Kawin','12346005','89751550','12300','1'),
    ('people-MBLE-220671','ERIK','nik_number','kk_number','WNI','Laki-laki','Default','1999-08-28','null','Kawin','12346006','89751551','12300','1'),
    ('people-MBLE-220672','RAHMAT ALMAN MAULANA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2000-06-26','B','Belum Kawin','12346007','89751552','12300','1'),
    ('people-MBLE-220673','AKHMAD YANI','nik_number','kk_number','WNI','Laki-laki','Liang Naga','1973-08-11','O','Kawin','12346008','89751553','12300','1'),
    ('people-MBLE-220674','SITI PURNAMA RATIH','nik_number','kk_number','WNI','Perempuan','Paring Lahung','2003-04-16','B','Belum Kawin','12346009','89751554','12300','1'),
    ('people-MBLE-220675','SHINTA MURYANI','nik_number','kk_number','WNI','Perempuan','Ngawi','1999-10-16','O','Belum Kawin','12346010','89751555','12300','1'),
    ('people-MBLE-220676','DAHAM','nik_number','kk_number','WNI','Laki-laki','Sragen','1987-03-15','null','Kawin','12346011','89751556','12300','1'),
    ('people-MBLE-220677','SATSANU ADEWITAKA','nik_number','kk_number','WNI','Laki-laki','Trinsing','1998-03-16','O','Belum Kawin','12346012','89751557','12300','1'),
    ('people-MBLE-220678','RAHMAH ALIYANI','nik_number','kk_number','WNI','Perempuan','Muara Teweh','2004-07-02','null','Belum Kawin','12346013','89751558','12300','1'),
    ('people-MBLE-220679','YUSTINUS SETU','nik_number','kk_number','WNI','Laki-laki','Ende','1985-08-12','AB','Belum Kawin','12346014','89751559','12300','1'),
    ('people-MBLE-220680','PANTAI','nik_number','kk_number','WNI','Laki-laki','Pangkan','1977-06-26','null','Kawin','12346015','89751560','12300','1'),
    ('people-MBLE-220681','SUPIAN','nik_number','kk_number','WNI','Laki-laki','Pendang','1995-10-07','null','Belum Kawin','12346016','89751561','12300','1'),
    ('people-MBLE-220682','MARDIANI','nik_number','kk_number','WNI','Laki-laki','Malungai Raya','1999-11-21','O','Kawin','12346017','89751562','12300','1'),
    ('people-MBLE-220683','EGY NANDA PUTRI','nik_number','kk_number','WNI','Perempuan','Puruk Cahu','2001-08-24','B','Belum Kawin','12346018','89751563','12300','1'),
    ('people-MBLE-220684','AHMAD PARWONO','nik_number','kk_number','WNI','Laki-laki','Klaten','1985-06-24','B','Duda','12346019','89751564','12300','1'),
    ('people-MBLE-220685','FAHREZA RAMADHANI','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12346020','89751565','12300','1'),
    ('people-MBLE-220686','EKSA PUTRA','nik_number','kk_number','WNI','Laki-laki',' Hajak','2003-05-03','null','Belum Kawin','12346021','89751566','12300','1'),
    ('people-MBLE-220687','FAUZI RAMADHAN','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2000-12-01','O','Belum Kawin','12346022','89751567','12300','1'),
    ('people-MBLE-220688','LUKAS','nik_number','kk_number','WNI','Laki-laki','Malawaken','1991-10-01','null','Kawin','12346023','89751568','12300','1'),
    ('people-MBLE-220690','RETNO SARI SUSILONINGRUM','nik_number','kk_number','WNI','Perempuan','Banjarnegara','1967-09-05','B','Kawin','12346024','89751569','12300','1'),
    ('people-MBLE-220691','RAHMAN','nik_number','kk_number','WNI','Laki-laki','Buntok','1999-07-23','O','Belum Kawin','12346025','89751570','12300','1'),
    ('people-MBLE-220692','SUGIANOR','nik_number','kk_number','WNI','Laki-laki','Muara Arai','2001-12-10','O','Kawin','12346026','89751571','12300','1'),
    ('people-MBLE-220693','NURHAJIAH','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12346027','89751572','12300','1'),
    ('people-MBLE-220694','MEGI','nik_number','kk_number','WNI','Laki-laki','Lemo I','1987-12-29','O','Kawin','12346028','89751573','12300','1'),
    ('people-MBLE-220695','HELMITA','nik_number','kk_number','WNI','Perempuan','Pangku Raya','2002-12-11','B','Belum Kawin','12346029','89751574','12300','1'),
    ('people-MBLE-220696','ERMITA IMELIA','nik_number','kk_number','WNI','Perempuan','Montallat','2002-01-12','null','Belum Kawin','12346030','89751575','12300','1'),
    ('people-MBLE-220698','NOPI ANSHARI','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12346031','89751576','12300','1'),
    ('people-MBLE-220697','MUHAMAD SAOFI EFENDI','nik_number','kk_number','WNI','Laki-laki','Banjarnegara','2002-05-01','B','Belum Kawin','12346032','89751577','12300','1'),
    ('people-MBLE-220699','LUCKY GUNAWAN','nik_number','kk_number','WNI','Laki-laki','Cilacap','1999-05-16','null','Belum Kawin','12346033','89751578','12300','1'),
    ('people-MBLE-220700','MERSA KRISMAWATI','nik_number','kk_number','WNI','Perempuan','Jaman','2002-08-26','A','Belum Kawin','12346034','89751579','12300','1'),
    ('people-MBLE-220701','ALMI SELA ADMAJA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2000-06-20','null','Belum Kawin','12346035','89751580','12300','1'),
    ('people-MBLE-220702','MUHAMMAD HATAMI','nik_number','kk_number','WNI','Laki-laki','Murung Panggang','1998-02-11','null','Belum Kawin','12346036','89751581','12300','1'),
    ('people-MBLE-220703','MUHAMAD RAFII','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','null','Belum Kawin','12346037','89751582','12300','1'),
    ('people-MBLE-220704','JHONI','nik_number','kk_number','WNI','Laki-laki','Malawaken','1982-10-29','O','Kawin','12346038','89751583','12300','1'),
    ('people-MBLE-220705','ALDI RIZALDI','nik_number','kk_number','WNI','Laki-laki','Malawaken','1998-10-03','null','Belum Kawin','12346039','89751584','12300','1'),
    ('people-MBLE-220706','ROHMAN','nik_number','kk_number','WNI','Laki-laki','Sukabumi','1997-02-15','O','Belum Kawin','12346040','89751585','12300','1'),
    ('people-MBLE-220707','SUHENDI HIKMATUROBI','nik_number','kk_number','WNI','Laki-laki','Sukabumi','2000-08-28','null','Belum Kawin','12346041','89751586','12300','1'),
    ('people-MBLE-220708','MAHYUDI SAPUTRA','nik_number','kk_number','WNI','Laki-laki','Lemo II','1996-07-05','B','Kawin','12346042','89751587','12300','1'),
    ('people-MBLE-220709','WILY','nik_number','kk_number','WNI','Laki-laki','Jakarta','1990-05-05','null','Kawin','12346043','89751588','12300','1'),
    ('people-MBLE-220710','JECKY HANGGARA','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2001-04-01','O','Belum Kawin','12346044','89751589','12300','1'),
    ('people-MBLE-220711','TRI SONIARTO','nik_number','kk_number','WNI','Laki-laki','Buntok','1998-03-02','B','Kawin','12346045','89751590','12300','1'),
    ('people-MBLE-220712','YUPADIN','nik_number','kk_number','WNI','Laki-laki','Malawaken','1971-07-01','O','Kawin','12346046','89751591','12300','1'),
    ('people-MBLE-220713','JUMADIL','nik_number','kk_number','WNI','Laki-laki','Tarusan','2001-08-07','A','Belum Kawin','12346047','89751592','12300','1'),
    ('people-MBLE-220714','TAUFIK RAHMAN','nik_number','kk_number','WNI','Laki-laki','Lemo II','2002-12-12','null','Belum Kawin','12346048','89751593','12300','1'),
    ('people-MBLE-220715','MUHAMMAD RASID RIDO','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2003-04-26','B','Belum Kawin','12346049','89751594','12300','1'),
    ('people-MBLE-220716','ANGGA YUDHA PUTRA','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','2004-05-05','A','Belum Kawin','12346050','89751595','12300','1'),
    ('people-MBLE-220717','DITA JAYA','nik_number','kk_number','WNI','Laki-laki','Lemo II','1999-03-01','null','Belum Kawin','12346051','89751596','12300','1'),
    ('people-MBLE-220718','RETNO SANJAYA','nik_number','kk_number','WNI','Laki-laki','Ruji','2000-04-09','B','Belum Kawin','12346052','89751597','12300','1'),
    ('people-MBLE-220719','RICHARD LEE SADEWO','nik_number','kk_number','WNI','Laki-laki','Tumpung Laung','2002-12-27','null','Belum Kawin','12346053','89751598','12300','1'),
    ('people-MBLE-220720','SELMA TIARA','nik_number','kk_number','WNI','Perempuan','Sikan','2004-06-08','B','Belum Kawin','12346054','89751599','12300','1'),
    ('people-MBLE-220721','PITRIANTO','nik_number','kk_number','WNI','Laki-laki','Muara Joloi','2000-03-12','A','Belum Kawin','12346055','89751600','12300','1'),
    ('people-MBLE-220722','REVI','nik_number','kk_number','WNI','Laki-laki','Malawaken','1999-10-03','B','Belum Kawin','12346056','89751601','12300','1'),
    ('people-MBLE-220723','RIVNO ALEGRA','nik_number','kk_number','WNI','Laki-laki','Malawaken','2002-10-10','O','Belum Kawin','12346057','89751602','12300','1'),
    ('people-MBLE-220724','RANDY PAONA','nik_number','kk_number','WNI','Laki-laki','Puruk Cahu','1996-12-03','B','Belum Kawin','12346058','89751603','12300','1'),
    ('people-MBLE-220726','AJI AKBAR','nik_number','kk_number','WNI','Laki-laki','Muara Teweh','2004-02-06','B','Belum Kawin','12346059','89751604','12300','1'),
    ('people-MBLE-0321100001','ZAYEN PRANA KUSMURI','nik_number','kk_number','WNI','Laki-laki','Default','2000-08-28','A','Belum Kawin','12346060','89751605','12300','1');
]
*/


















































































































































































































































































































































































