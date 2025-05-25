<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\News;
use App\Models\DocumentType;
use App\Models\DocumentStatus;
use App\Models\MainEntryHeading;
use App\Models\Theme;
use App\Models\Label;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;

class DocumentAndNewsSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample document types if not exists
        $documentTypes = [
            ['type_name' => 'Peraturan Daerah', 'description' => 'Peraturan yang ditetapkan oleh DPRD'],
            ['type_name' => 'Peraturan Gubernur', 'description' => 'Peraturan yang ditetapkan oleh Gubernur'],
            ['type_name' => 'Keputusan Gubernur', 'description' => 'Keputusan yang ditetapkan oleh Gubernur'],
        ];

        foreach ($documentTypes as $type) {
            DocumentType::firstOrCreate(['type_name' => $type['type_name']], $type);
        }

        // Create sample document statuses if not exists
        $statuses = [
            ['status_name' => 'Draft', 'description' => 'Dokumen dalam tahap penyusunan'],
            ['status_name' => 'Published', 'description' => 'Dokumen telah dipublikasikan'],
            ['status_name' => 'Archived', 'description' => 'Dokumen telah diarsipkan'],
        ];

        foreach ($statuses as $status) {
            DocumentStatus::firstOrCreate(['status_name' => $status['status_name']], $status);
        }

        // Create sample headings if not exists
        $headings = [
            ['heading_name' => 'Pemerintah Provinsi', 'description' => 'Lembaga eksekutif tingkat provinsi'],
            ['heading_name' => 'Dewan Perwakilan Rakyat Daerah', 'description' => 'Lembaga legislatif tingkat provinsi'],
        ];

        foreach ($headings as $heading) {
            MainEntryHeading::firstOrCreate(['heading_name' => $heading['heading_name']], $heading);
        }

        // Create sample themes if not exists
        $themes = [
            ['theme_name' => 'Pendidikan', 'description' => 'Tema terkait pendidikan'],
            ['theme_name' => 'Kesehatan', 'description' => 'Tema terkait kesehatan'],
            ['theme_name' => 'Infrastruktur', 'description' => 'Tema terkait infrastruktur'],
        ];

        foreach ($themes as $theme) {
            Theme::firstOrCreate(['theme_name' => $theme['theme_name']], $theme);
        }

        // Create sample labels if not exists
        $labels = [
            ['label_name' => 'Penting', 'description' => 'Label untuk dokumen penting'],
            ['label_name' => 'Urgent', 'description' => 'Label untuk dokumen mendesak'],
            ['label_name' => 'Draft', 'description' => 'Label untuk dokumen draft'],
        ];

        foreach ($labels as $label) {
            Label::firstOrCreate(['label_name' => $label['label_name']], $label);
        }

        // Create sample categories if not exists
        $categories = [
            ['name' => 'Pemerintahan', 'slug' => 'pemerintahan', 'description' => 'Kategori berita pemerintahan'],
            ['name' => 'Pembangunan', 'slug' => 'pembangunan', 'description' => 'Kategori berita pembangunan'],
            ['name' => 'Sosial', 'slug' => 'sosial', 'description' => 'Kategori berita sosial'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        // Create sample tags if not exists
        $tags = [
            ['name' => 'Pemerintah', 'slug' => 'pemerintah'],
            ['name' => 'Daerah', 'slug' => 'daerah'],
            ['name' => 'Pembangunan', 'slug' => 'pembangunan'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        // Create a default user if not exists
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        // Create 20 sample documents
        for ($i = 1; $i <= 20; $i++) {
            $document = Document::create([
                'title' => "Dokumen Contoh {$i}",
                'document_number' => "DOC-{$i}/" . date('Y'),
                'document_year' => date('Y'),
                'description' => "Deskripsi untuk dokumen contoh {$i}",
                'issuance_date' => Carbon::now()->subDays(rand(1, 30)),
                'announcement_date' => Carbon::now()->subDays(rand(1, 30)),
                'type_id' => DocumentType::inRandomOrder()->first()->type_id,
                'status_id' => DocumentStatus::inRandomOrder()->first()->status_id,
                'heading_id' => MainEntryHeading::inRandomOrder()->first()->heading_id,
                'has_consolidation' => rand(0, 1),
                'has_translation' => rand(0, 1),
                'thumbnail_url' => "https://example.com/thumbnails/doc-{$i}.jpg",
                'preview_url' => "https://example.com/previews/doc-{$i}.pdf",
                'file_path' => "documents/doc-{$i}.pdf",
            ]);

            // Attach random themes and labels
            $document->themes()->attach(Theme::inRandomOrder()->take(2)->pluck('theme_id'));
            $document->labels()->attach(Label::inRandomOrder()->take(2)->pluck('label_id'));
        }

        // Create 20 sample news articles
        for ($i = 1; $i <= 20; $i++) {
            $news = News::create([
                'user_id' => $user->id,
                'title' => "Berita Contoh {$i}",
                'slug' => "berita-contoh-{$i}-" . time(),
                'content' => "Ini adalah konten berita contoh {$i}. Berita ini berisi informasi penting tentang berbagai topik yang relevan dengan pembangunan daerah.",
                'thumbnail_path' => "news/thumbnails/news-{$i}.jpg",
                'published_at' => Carbon::now()->subDays(rand(1, 30)),
                'meta_description' => "Deskripsi meta untuk berita contoh {$i}",
                'status' => 'published',
            ]);

            // Attach random categories and tags
            $news->categories()->attach(Category::inRandomOrder()->take(2)->pluck('id'));
            $news->tags()->attach(Tag::inRandomOrder()->take(2)->pluck('id'));
        }
    }
} 