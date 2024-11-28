import hashlib

# Liste des algorithmes de hachage disponibles
HASH_ALGORITHMS = ['md5', 'sha1', 'sha224', 'sha256', 'sha384', 'sha512']

def detect_hash_function(hashed_value, original_value):
    possible_algorithms = []

    for algo in HASH_ALGORITHMS:
        h = hashlib.new(algo)
        h.update(original_value.encode())
        if h.hexdigest() == hashed_value:
            possible_algorithms.append(algo)

    return possible_algorithms

# Exemple d'utilisation
if __name__ == "__main__":
    hashed = input("Entrez la donnée hachée : ")
    original = input("Entrez la donnée d'origine : ")
    matches = detect_hash_function(hashed, original)

    if matches:
        print(f"La fonction de hachage correspondante pourrait être : {', '.join(matches)}")
    else:
        print("Aucune correspondance trouvée.")
