<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();

            // Informasi Sales & Branch
            $table->string('sales_id');
            $table->string('sales_name');
            $table->string('branch'); // Tandes, Surabaya Pusat, dll.

            // Data Usaha/Pelanggan
            $table->string('business_name');
            $table->text('address');
            $table->string('coordinates'); // Menyimpan lat, long

            // Data Person In Charge (PIC)
            $table->string('pic_name');
            $table->string('pic_phone');
            $table->string('pic_email');
            $table->string('pic_nik', 16); // NIK 16 digit

            // Jenis Layanan
            $table->string('service_type'); // IndiHome, Astinet, dll.

            // Dokumen Pendukung (Menyimpan path/nama file)
            $table->string('ktp_photo_path');
            $table->string('building_photo_path');
            $table->string('support_doc_path')->nullable(); // Opsional

            // Informasi Tambahan
            $table->text('notes')->nullable();
            $table->string('status')->default('processing'); // Sesuai default di JS: 'processing'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
