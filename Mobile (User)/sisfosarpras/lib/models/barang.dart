class BarangModel {
  final int id;
  final String nama;
  final String? deskripsi;
  final int stok;
  final String? foto;
  final int kategoriId;
  final String kategori; // kategori name
  final DateTime? createdAt;
  final DateTime? updatedAt;

  BarangModel({
    required this.id,
    required this.nama,
    this.deskripsi,
    required this.stok,
    this.foto,
    required this.kategoriId,
    required this.kategori,
    this.createdAt,
    this.updatedAt,
  });

  // Factory constructor to create BarangModel from JSON
  factory BarangModel.fromJson(Map<String, dynamic> json) {
    return BarangModel(
      id: json['id'] ?? 0,
      nama: json['nama'] ?? '',
      deskripsi: json['deskripsi'],
      stok: json['stok'] ?? 0,
      foto: json['foto'],
      kategoriId: json['kategori_id'] ?? 0,
      kategori: json['kategori']?['nama'] ?? json['kategori'] ?? '',
      createdAt: json['created_at'] != null 
          ? DateTime.tryParse(json['created_at']) 
          : null,
      updatedAt: json['updated_at'] != null 
          ? DateTime.tryParse(json['updated_at']) 
          : null,
    );
  }

  // Convert BarangModel to JSON
  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'nama': nama,
      'deskripsi': deskripsi,
      'stok': stok,
      'foto': foto,
      'kategori_id': kategoriId,
      'kategori': kategori,
      'created_at': createdAt?.toIso8601String(),
      'updated_at': updatedAt?.toIso8601String(),
    };
  }

  // Copy with method for updating specific fields
  BarangModel copyWith({
    int? id,
    String? nama,
    String? deskripsi,
    int? stok,
    String? foto,
    int? kategoriId,
    String? kategori,
    DateTime? createdAt,
    DateTime? updatedAt,
  }) {
    return BarangModel(
      id: id ?? this.id,
      nama: nama ?? this.nama,
      deskripsi: deskripsi ?? this.deskripsi,
      stok: stok ?? this.stok,
      foto: foto ?? this.foto,
      kategoriId: kategoriId ?? this.kategoriId,
      kategori: kategori ?? this.kategori,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }

  @override
  String toString() {
    return 'BarangModel(id: $id, nama: $nama, stok: $stok, kategori: $kategori)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;
    return other is BarangModel && other.id == id;
  }

  @override
  int get hashCode => id.hashCode;
}